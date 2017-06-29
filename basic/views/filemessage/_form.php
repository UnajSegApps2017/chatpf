<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use kartik\file\FileInput;
 
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Filemessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="filemessage-form">
    <?php 
      $form = ActiveForm::begin([
          'options'=>['enctype'=>'multipart/form-data']]); // important         
           ?>

               

    <div class="row">
      <?= $form->field($model, 'headderMessage')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,],
          ]);   ?>
  </div>
    <div class="row">
                  
    <div class="form-group">
 <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     </div>
   </div>

</div>
