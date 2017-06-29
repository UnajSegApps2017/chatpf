<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $subModelContacts app\models\ContactsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="newchat-contactsearch">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($subSearchContactsModel, 'idContact') ?>

    <?= $form->field($subSearchContactsModel, 'idUser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
