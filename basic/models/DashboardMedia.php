<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
/**
 * This is the model class for table "DashboardMedia".
 *
 * @property integer $id_media
 * @property string $filename
 * @property integer $id_autor
 * @property string $fecha
 * @property string $extencion
 */
class DashboardMedia extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DashboardMedia';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['filename', 'id_autor'], 'required'],
            [['id_autor'], 'integer'],
            [['fecha'], 'safe'],
            [['filename'], 'file'],
            [['extencion'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_media' => 'Id Media',
            'filename' => 'Filename',
            'id_autor' => 'Id Autor',
            'fecha' => 'Fecha',
            'extencion' => 'Extencion',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $this->filename->saveAs('uploads/' . $this->filename->baseName . '.' . $this->filename->extension);
            return true;
        } else {
            return false;
        }
    }

//    public function getIdAutor() {
//        return $this->hasOne(Users::className(), ['id_user' => 'id_autor']);
//    }

}
