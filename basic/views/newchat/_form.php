<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Newchat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="newchat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'headderMessage')->textInput() ?>

    <?= $form->field($model, 'messageContent')->textInput() ?>

    <?= $form->field($model, 'messagedelievered')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
