<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Message}}".
 *
 * @property integer $idMessage
 * @property resource $headderMessage
 * @property resource $messageContent
 * @property integer $messagedelievered
 */
class Newchat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['headderMessage', 'messageContent', 'messagedelievered'], 'required'],
            [['headderMessage', 'messageContent'], 'string'],
            [['messagedelievered'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMessage' => Yii::t('app', 'Id Message'),
            'headderMessage' => Yii::t('app', 'Headder Message'),
            'messageContent' => Yii::t('app', 'Message Content'),
            'messagedelievered' => Yii::t('app', 'Messagedelievered'),
        ];
    }

    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }
}
