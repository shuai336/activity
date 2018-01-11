<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PrizeToUser */

$this->title = 'Update Prize To User: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Prize To Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prize-to-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
