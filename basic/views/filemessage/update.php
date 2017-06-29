<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Filemessage */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Filemessage',
]) . $model->idMessage;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Filemessages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMessage, 'url' => ['view', 'id' => $model->idMessage]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="filemessage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
