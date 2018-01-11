<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prize */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prize-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prize_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'rest')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('确定修改', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
