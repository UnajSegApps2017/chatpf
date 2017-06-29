<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Message".
 *
 * @property integer $idMessage
 * @property resource $headderMessage
 * @property resource $messageContent
 * @property integer $messagedelievered
 */
class Filemessage extends \yii\db\ActiveRecord {

    public $messageContent;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Message';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['headderMessage', 'messageContent', 'messagedelievered'], 'required'],
            [['headderMessage', 'messageContent'], 'safe'],
            [['messageContent'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
            //[['headderMessage'], 'file', 'extensions'=>'jpg, gif, png'],
            //[['headderMessage'], 'file', 'maxSize'=>'100000'],
            //[['messageContent'], 'string', 'max' => 255],
            [['messagedelievered'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idMessage' => Yii::t('app', 'Id Message'),
            'headderMessage' => Yii::t('app', 'Headder Message'),
            'messageContent' => Yii::t('app', 'Message Content'),
            'messagedelievered' => Yii::t('app', 'Messagedelievered'),
        ];
    }

//    public function uploadAudioFile():bool{
//        if ($this->_audiofile === null){
//			 return false;
//		} else {
//                    
//			return true;
//        }
//    }

    public function uploadFile() {
        // get the uploaded file instance
        $image = UploadedFile::getInstance($this, 'messageContent');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // generate random name for the file
        //$this->pic = time() . '.' . $image->extension;

        // the uploaded image instance
        return $image;
    }

//    public function getUploadedFile() {
//        // return a default image placeholder if your source avatar is not found
//        $pic = isset($this->pic) ? $this->pic : 'default.png';
//        return Yii::$app->params['fileUploadUrl'] . $pic;
//    }

}
