<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrizeToUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prize To Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prize-to-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => '用户名',
                'value' => 'user.username',
            ],
            [
                'label' => '地区',
                'value' => 'user.region',
            ],
            [
                'label' => '联系方式',
                'value' => 'user.phone',
            ],
            [
                'label' => '奖品名称',
                'value' => 'prize.prize_name',
            ],
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
