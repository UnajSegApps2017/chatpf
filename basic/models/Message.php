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
class Message extends \yii\db\ActiveRecord {

    public $mesageContent;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%Message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['messageContent'], 'required'],
            [['headderMessage', 'messageContent'], 'string'],
            [['messagedelievered'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idMessage' => 'Id Message',
            'headderMessage' => 'Headder Message',
            'messageContent' => 'Message Content',
            'messagedelievered' => 'Messagedelievered',
        ];
    }

}
