<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $modelNew app\models\Filemessage */

$this->title = 'Nuevo Mensaje';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-nuevomensaje">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFilemessage', [
        'model' => $model,
    ]) ?>

</div>
