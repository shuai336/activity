<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prize */

$this->title = '修改奖品';
$this->params['breadcrumbs'][] = ['label' => '奖品', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="prize-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
