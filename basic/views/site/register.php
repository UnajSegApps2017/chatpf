<?php

/* @var $this yii\web\View */
//use yii\helpers\CHtml;


use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;

?>
<h3><?= $msg ?></h3>

<div class="site-about">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="register-form">
		<?php $form = ActiveForm::begin(); ?>
		<div class="row">
            <div class="col-lg-6">

				<?= $form->field($model, "username")->input("text") ?>

				<?= $form->field($model, "email")->input("email") ?>

				<?= $form->field($model, "password")->input("password") ?>

				<?= $form->field($model, "password_repeat")->input("password") ?>
				
				
			</div>
				
			<div class="col-lg-6">
				<?= $form->field($model, "publicKey")->textarea(["rows" => "12"]) ?>
				
				
			</div>
		</div>
		<?= Html::submitButton("Register", ["class" => "btn btn-primary"]) ?>
	 
        <?php ActiveForm::end(); ?>
    
</div>
    
