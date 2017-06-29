<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = 'Update Contacts: ' . $model->idUser;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idUser, 'url' => ['view', 'idUser' => $model->idUser, 'idContacted' => $model->idContacted]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contacts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
