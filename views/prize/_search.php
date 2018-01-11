<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrizeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prize-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'prize_name') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'role') ?>

    <?= $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'rest') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
