<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DashboardMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dashboard Media', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //IMAGEN DEL DOCUMENTO / IMAGEN
            [
                'attribute' => 'filename',
                'format' => 'html',
                'label' => 'ImageColumnLable',
                'value' => function ($data) {
                    return Html::img('uploads/' . $data['filename'], ['width' => '100px']);
                },
            ],
            //NOMBRE + URL DEL DOCUMENTO / IMAGEN
            [
                'label' => 'File',
                'format' => 'raw',
                'value' => function ($data) {
                    $url = "uploads/" . $data->filename;
                    return Html::a($data->filename, $url);
                },
            ],
            //'id_autor',
            //'autor'=> Users::find()->select('username')->where(['id_user'=>'id_autor'])->one(),
            'fecha',
            'extencion',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>