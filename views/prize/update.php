<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prize */

$this->title = '修改奖品';
$this->params['breadcrumbs'][] = ['label' => '奖品', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改奖品';
?>
<div class="prize-update">

    <h1><?= Html::encode($this->title.': '.$model->prize_name) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <p>
        说明：奖品role为 1 时，每个用户最多抽中一次；<br>&emsp;&emsp;&ensp;&nbsp;
        奖品role为 2 时，每个用户每天最多抽中一次。
    </p>

</div>
