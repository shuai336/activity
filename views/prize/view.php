<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prize */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '奖品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prize-view">

    <h1><?= Html::encode($model->prize_name) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除该项吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'prize_name',
            'value',
            'role',
            'number',
            'rest',
            'weight',
        ],
    ]) ?>

</div>
