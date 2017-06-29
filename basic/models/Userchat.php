<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Userchat".
 *
 * @property integer $idUser
 * @property string $nameUser
 * @property string $passwordUser
 * @property resource $publicKeyUser
 * @property string $mailUser
 * @property string $authkeyUser
 * @property integer $activUser
 *
 * @property Contacts[] $contacts
 */
class Userchat extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Userchat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameUser', 'passwordUser', 'publicKeyUser', 'mailUser'], 'required'],
            [['publicKeyUser'], 'string'],
            [['activUser'], 'integer'],
            [['nameUser'], 'string', 'max' => 20],
            [['passwordUser', 'mailUser', 'authkeyUser'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'nameUser' => 'Name User',
            'passwordUser' => 'Password User',
            'publicKeyUser' => 'Public Key User',
            'mailUser' => 'Mail User',
            'authkeyUser' => 'Authkey User',
            'activUser' => 'Activ User',
        ];
    }
     
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts0::className(), ['idUser' => 'idContacted']);
    }

    public function getAuthKey(): string {
        return $this->authkeyUser;
    }

    public function getId() {
        return $this->idUser;
    }
    
    public function getPublicKeyUser(): string {
		return $this->publicKeyUser;
	}

    public function validateAuthKey($authKey): bool {
        $usr=Userchat::find()->where ( "authkeyUser=:authkeyUser", [":authkeyUser" => 
            crypt($authKey, Yii::$app->params["salt"])]);
        if ($usr->count() == 1) {
            return true;
        }
        return false;
    }

    public static function findIdentity($id): IdentityInterface {
        return Userchat::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): IdentityInterface {
        return Userchat::findOne(['authkeyUser' => $token]);
    }
    
    public static function findByUsername($username){
        return Userchat::findOne(['nameUser' => $username]);
    }
    
    public static function getAllUserchats(){
        return Userchat::find()->all();
    }
}
