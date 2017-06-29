<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\UploadedFile;

class FileForm extends ActiveRecord{

    /* PROPERTY FOR RECEIVING THE FILE FROM FORM*/          
    public $cv_file_name;
    private $file;
    /* MUST BE THE SAME AS FORM INPUT FIELD NAME*/          

    /**
    *saves the name, size ,type and data of the uploaded file
    */
    public function beforeSave(){
        if($file=UploadedFile::getInstance($this,'cv_file_name')){
        $this->cv_file_name=$file->name;
        $this->cv_file_type=$file->type;
        $this->cv_file_size=$file->size;
        $this->cv_file_content=UploadedFile::file_get_contents($file->tempName);
        }
        return parent::beforeSave();;
    }
}