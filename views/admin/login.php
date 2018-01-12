<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

AppAsset::register($this);
$this->context->layout = false;
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
    <div class="container">
        <h1>管理员登陆</h1>
        <br>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username', ['labelOptions' => ['label' => '用户名']])->textInput(['autocomplete' => 'off']) ?>

        <?= $form->field($model, 'password', ['labelOptions' => ['label' => '密码']])->passwordInput(['autocomplete' => 'off']) ?>

        <div class="form-group">
            <?= Html::submitButton('登 陆', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
