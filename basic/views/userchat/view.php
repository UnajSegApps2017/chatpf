<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Userchat */

$this->title = $model->idUser;
$this->params['breadcrumbs'][] = ['label' => 'Userchats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userchat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idUser], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idUser], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idUser',
            'nameUser',
            'passwordUser',
            'publicKeyUser',
            'mailUser',
            'authkeyUser',
            'activUser',
        ],
    ]) ?>

</div>
