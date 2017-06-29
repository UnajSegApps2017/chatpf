<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $modelNew app\models\Filemessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nuevomensaje-form">
    <?php
    $form = ActiveForm::begin(); // important         
    ?>



    <div class="row">
        <?=
        $form->field($model, 'message')->textarea(["rows" => "12"])
        ?>
    </div>
    <div class="row">

        <div class="form-group">
            <?= Html::submitButton("Nuevomensaje", ["class" => "btn btn-primary"]) ?>

        </div>
    </div>

</div>
