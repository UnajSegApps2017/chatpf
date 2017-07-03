<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\commands\Intranet;
use app\commands\Mailto;
use app\commands\RandKey;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\Userchat;
use app\models\UploadForm;
use yii\web\UploadedFile;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'contact', 'register', 'login',],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'logout', 'contact', 'register',],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'register',],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['contact', 'login'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
            //return $this->redirect(['newchat/index']);
        }
        return $this->render('login', ['model' => $model,]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionConfirm() {
        if (Yii::$app->request->get()) {
            $id = Html::encode($_GET["id"]);$authKey = $_GET["authKey"];
            if ((int) $id) {
                $usr = Userchat::find()->where("idUser=:idUser", [":idUser" => $id])
                    ->andWhere("authkeyUser=:authkeyUser", [":authkeyUser" => $authKey]);
                if ($usr->count() == 1) {
                    $activar = Userchat:: find()->where("idUser=:idUser", [":idUser" => $id])
                        ->andWhere("authkeyUser=:authkeyUser", [":authkeyUser" => $authKey])->one();
                    $activar->activUser = 1;
                    if ($activar->update() !== false) {
                        echo "Registro ok en chatpf, redireccionando..";
                        echo "<meta http-equiv='refresh' content='8; " . Url::toRoute("site/login") . "'>";
                    } else {
                        echo "Registro fallido en chatpf, redireccionando..";
                        echo "<meta http-equiv='refresh' content='8; " . Url::toRoute("site/login") . "'>";
                    }
                }
            } else return $this->redirect(["site/login"]);
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionRegister() {
        $model = new RegisterForm();
        $msg = null;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $table = new Userchat();
                $this->fillModelUserchat($table, $model);
                if ($table->insert()) {
                    $msg = $this->sendConfirm($table);
                    $this->nullModelRegister($model);
                } else {
                    $msg = "Ha ocurrido un error al llevar a cabo tu  registro\n";
                }
            } else {
                $model->getErrors();
            }
        }
        return $this->render("register", ["model" => $model, "msg" => $msg]);
    }

    public function actionUpload() {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'imageFile');
            $image_name = $model->upload();
            if ($image_name) {
                echo $image_name . " is uploaded successfully";
                die;
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    private function nullModelRegister($model){
        $model->username = null;
        $model->email = null;
        $model->password = null;
        $model->password_repeat = null;
        $model->publicKey = null;
    }

    private function fillModelUserchat($src,$src2){
        $src->loadDefaultValues();
        $src->nameUser = $src2->username;
        $src->mailUser = $src2->email;
        $src->passwordUser = crypt($src2->password, Yii::$app->params["salt"]);
        $src->authkeyUser = RandKey::randKey("abcdef0123456789", 200);
        $src->publicKeyUser = $src2->publicKey;
    }

    private function sendConfirm($table1){
        $user1 = Userchat::find()->Where("authkeyUser=:authkeyUser", [":authkeyUser" => $table1->authkeyUser])->one();
        $id = urlencode($user1->idUser);
        $authKey = urlencode($user1->authkeyUser);
        $subject = "Confirmar registro";
        $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
        $link = Intranet::getUrlHead() . "/basic/web/index.php?r=site/confirm&id=" . $id . "&authKey=" . $authKey;
        $body .= "<a href='" . $link . "'>Confirmar</a>";
        if (Yii::$app->params["adminEmail"] != 'email@gmail.com') {
            Yii::$app->mailer->compose()->setTo($user1->mailUser)
                    ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                    ->setSubject($subject)->setHtmlBody($body)->send();
            return "Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo ";
        } else {
            return "Confirmación alternativa " . Mailto::getUrlMailto(
            $user1->mailUser, $subject, "", "", "Haga click en el siguiente enlace para finalizar tu registro", $link, "\nClick aquí para reenviar confirmación vía mailto:"
            );
        }
    }

}
