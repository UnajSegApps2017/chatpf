<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserchatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Userchats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userchat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Userchat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idUser',
            'nameUser',
            'passwordUser',
            'publicKeyUser',
            'mailUser',
            'authkeyUser',
            'activUser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
