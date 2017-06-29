<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Contacts".
 *
 * @property integer $idUser
 * @property integer $idContacted
 *
 * @property Userchat $idContacted0
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idContacted'], 'required'],
            [['idUser', 'idContacted'], 'integer'],
            [['idContacted'], 'exist', 'skipOnError' => true, 'targetClass' => Userchat::className(), 'targetAttribute' => ['idContacted' => 'idUser']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'idContacted' => 'Id Contacted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContacted0()
    {
        return $this->hasOne(Userchat::className(), ['idUser' => 'idContacted']);
    }
    
    public function getContactname() {
        return Userchat::findOne($this->idContacted)->nameUser;
    }

}
