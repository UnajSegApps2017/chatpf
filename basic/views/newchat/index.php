<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NewchatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Newchats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newchat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Newchat'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'idMessage',
                'headderMessage',
                'messageContent',
                'messagedelievered',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Contacts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $subDataProvider,
        'filterModel' => $subSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idContacted',
            [
             'attribute'=>'Nombre del Contacto',
            'value'=>'contactname',
            ],
//            [
//                'format' => 'raw',
//                'value' => function($modelNew) {
//                        return Html::a(
//                            '<i class="fa fa-euro"></i>',
//                            Url::to(['contacts/nuevomensaje','idUser'=> $modelNew->idUser, 'idContacted'=> $modelNew->idContacted]), 
//                            [
//                                'id'=>'grid-custom-button',
////                                'data-pjax'=>true,
//                                'action'=>Url::to(['contacts/nuevomensaje','idUser'=> $modelNew->idUser, 'idContacted'=> $modelNew->idContacted]),
//                                'class'=>'button btn btn-default',
//                            ]
//                        );
//                }
//
//            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],    ]); ?>
</div>
