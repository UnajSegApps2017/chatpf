<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contacts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idContacted',
//            'idUser',
            [
             'attribute'=>'Nombre del Contacto',
            'value'=>'contactname',
            ],
            [
                'format' => 'raw',
                'value' => function($model) {
                        return Html::a(
                            '<i class="glyphicon glyphicon-envelope"></i>',
                            Url::to(['message/nuevomensaje','idUser'=> $model->idUser, 'idContacted'=> $model->idContacted]), 
                            [
                                'id'=>'grid-custom-button',                              
                                'data-pjax'=>true,
                                'action'=>Url::to(['message/nuevomensaje','idUser'=> $model->idUser, 'idContacted'=> $model->idContacted]),
                                'class'=>'button btn btn-default',
                            ]
                        );
                }

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
