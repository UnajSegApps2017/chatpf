<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Newchat */

$this->title = $model->idMessage;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newchats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newchat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idMessage], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idMessage], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idMessage',
            'headderMessage',
            'messageContent',
            'messagedelievered',
        ],
    ]) ?>

</div>
