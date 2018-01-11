<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrizeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '奖品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prize-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加奖品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "共 {totalCount} 项奖品，本页显示 {begin} - {end} 项",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'prize_name',
            'value',
            'role',
            'number',
            'rest',
            'weight',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '80'],
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['del', 'id' => $key],
                            ['data' => ['confirm' => '你确定删除这项奖品吗？'],
                            'title' => 'delete']
                        );
                    }
                ]
            ],
        ],
    ]); ?>

    <p>
        说明：奖品role为 1 时，每个用户最多抽中一次；<br>&emsp;&emsp;&ensp;&nbsp;
        奖品role为 2 时，每个用户每天最多抽中一次。
    </p>
</div>
