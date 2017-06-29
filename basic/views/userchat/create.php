<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Userchat */

$this->title = 'Create Userchat';
$this->params['breadcrumbs'][] = ['label' => 'Userchats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userchat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
