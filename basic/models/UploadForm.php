<?php

namespace app\models;

use yii\base\Model;

class UploadForm extends Model {

    /**
     * instance of UploadedFile
     */
    public $message;

    /**
     * define rules for uploading image
     */
    public function rules() {
        return [
            [['message'], 'required'],
        ];
    }

    /**
     * Function to upload image into /web/uploads directory
     */
    public function upload() {
        if ($this->validate()) {
            $this->image->saveAs('/' . $this->image->baseName . '.' . $this->image->extension);
            return $this->image->name;
        } else {
            return false;
        }
    }

}
