<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DashboardMediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dashboard-media-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_media') ?>

    <?= $form->field($model, 'filename') ?>

    <?= $form->field($model, 'id_autor') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'extencion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
