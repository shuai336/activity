<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PrizeToUser */

$this->title = 'Create Prize To User';
$this->params['breadcrumbs'][] = ['label' => 'Prize To Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prize-to-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
