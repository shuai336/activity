<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prize */

$this->title = '添加奖品';
$this->params['breadcrumbs'][] = ['label' => '奖品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prize-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <p>
        说明：奖品role为 1 时，每个用户最多抽中一次；<br>&emsp;&emsp;&ensp;&nbsp;
        奖品role为 2 时，每个用户每天最多抽中一次。
    </p>
    <p>
        请对比其他奖品，谨慎填写权重！
    </p>

</div>
