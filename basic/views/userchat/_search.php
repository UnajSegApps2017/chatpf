<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserchatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userchat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'nameUser') ?>

    <?= $form->field($model, 'passwordUser') ?>

    <?= $form->field($model, 'publicKeyUser') ?>

    <?= $form->field($model, 'mailUser') ?>

    <?php // echo $form->field($model, 'authkeyUser') ?>

    <?php // echo $form->field($model, 'activUser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
