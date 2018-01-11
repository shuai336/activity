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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'label' => 'username',
//                'attribute' => 'username',
                'value' => 'username',
            ],
            [
                'label' => 'phone',
//                'attribute' => 'user.phone',
                'value' => 'phone',
            ],
            [
                'label' => 'prize_name',
//                'attribute' => 'prize.prize_name',
                'value' => 'prize_name',
            ],
            'data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
