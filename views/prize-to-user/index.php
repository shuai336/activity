<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrizeToUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '奖品获得情况';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prize-to-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "共 {totalCount} 条信息，本页显示 {begin} - {end} 条",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => '用户名',
                'attribute' => 'username',
                'value' => 'user.username',
            ],
            [
                'label' => '地区',
                'attribute' => 'region',
                'value' => 'user.region',
            ],
            [
                'label' => '联系方式',
                'attribute' => 'phone',
                'value' => 'user.phone',
            ],
            [
                'label' => '奖品名称',
                'attribute' => 'prize_name',
                'value' => 'prize.prize_name',
            ],
            'date',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['del', 'id' => $key],
                            ['data' => ['confirm' => '你确定删除这项奖品吗？'],
                                'title' => 'delete']
                        );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
