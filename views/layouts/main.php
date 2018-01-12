<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '后台管理',
        'brandUrl' => ['/prize/index'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '首页', 'url' => ['/prize/index']],
            ['label' => '用户信息', 'url' => ['/user-info']],
            ['label' => '获奖情况', 'url' => ['/prize-to-user']],
            ['label' => '每日抽奖次数', 'url' => ['/prize/game-time']],
//            if ( Yii::$app->user->identity) {
//                return ['lable' => '修改密码', 'url' => ['']];
//            }
            Yii::$app->user->identity ? (['label' => '修改密码', 'url' => ['/admin/update?id='.Yii::$app->user->id]]) : (['label' => '']),
            Yii::$app->user->isGuest ? (
            ['label' => '登陆', 'url' => ['/admin/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/admin/logout'], 'post')
                . Html::submitButton(
                    '退出登陆 (' . Yii::$app->user->identity->admin_name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => '主 页',
                'url' => ['/prize/index'],
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <!--        <p class="pull-right">--><? //= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
