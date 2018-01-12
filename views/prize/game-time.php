<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GameTime */
/* @var $form yii\widgets\ActiveForm */

$this->title = '每日游戏次数';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="game-time-form">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('确 定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>