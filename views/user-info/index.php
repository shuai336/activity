<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "共 {totalCount} 个用户，本页显示 {begin} - {end} 项",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'phone',
            'region',
//            'openid',
            //'access_token',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['del', 'id' => $key],
                            ['data' => ['confirm' => '你确定删除该用户吗？'],
                                'title' => 'delete']
                        );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
