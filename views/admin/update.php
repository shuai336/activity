<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */

$this->title = '修改密码';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="game-time-form">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'admin_name', ['labelOptions' => ['label' => '用户名']])->textInput(['autocomplete' => 'off']) ?>

    <?= $form->field($model, 'password', ['labelOptions' => ['label' => '密码']])->passwordInput(['autocomplete' => 'off']) ?>

    <div class="form-group">
        <?= Html::submitButton('确 定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>