<?php

namespace app\controllers;

use Yii;
use app\models\Contacts;
use app\models\ContactsSearch;
use app\models\Userchat;
use app\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete',],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete',],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
     * @param integer $idUser
     * @param integer $idContacted
     * @return mixed
     */
    public function actionView($idUser, $idContacted) {
        return $this->render('view', [
                    'model' => $this->findModel($idUser, $idContacted),
        ]);
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Contacts();
        $model->idUser = Yii::$app->user->identity->idUser;
        $subModel = new Userchat();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idUser' => $model->idUser, 'idContacted' => $model->idContacted]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'subModel' => $subModel,
            ]);
        }
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idUser
     * @param integer $idContacted
     * @return mixed
     */
    public function actionUpdate($idUser, $idContacted) {
        $model = $this->findModel($idUser, $idContacted);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idUser' => $model->idUser, 'idContacted' => $model->idContacted]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idUser
     * @param integer $idContacted
     * @return mixed
     */
    public function actionDelete($idUser, $idContacted) {
        $this->findModel($idUser, $idContacted)->delete();
        return $this->redirect(['index']);
    }

    public function actionNuevomensaje($idUser, $idContacted) {
        $model = new UploadForm();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $$table = new Filemessage();
                $usr = Userchat::find()
                                ->where("idUser=:idUser", [":idUser" => $idContacted])->one();
                $gpg = new \GPG();
                $table->loadDefaultValues();
                $table->messageContent = $gpg->encrypt(new \GPG_Public_Key($usr->publicKeyUser), $model->message);
                $table->headderMessage = $idContacted;
                if ($table->insert()) {
                    return $this->redirect(['contacts']);
                } else {
                    $model->getErrors();
                }
            }
        }
        return $this->render('nuevomensaje', [
                    'model' => $model,
        ]);
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idUser
     * @param integer $idContacted
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idUser, $idContacted) {
        if (($model = Contacts::findOne(['idUser' => $idUser, 'idContacted' => $idContacted])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
