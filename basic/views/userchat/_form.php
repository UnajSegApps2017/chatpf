<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Userchat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userchat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nameUser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passwordUser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publicKeyUser')->textInput() ?>

    <?= $form->field($model, 'mailUser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authkeyUser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activUser')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
