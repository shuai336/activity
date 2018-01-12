<?php

namespace app\controllers;

use app\models\Admin;
use app\models\AdminLoginForm;
use app\models\SignupForm;
use TheSeer\Tokenizer\Exception;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    
    public function actionIndex()
    {
        return $this->redirect(['/admin/login']);
    }

    public function actionLogin()
    {
        if (Yii::$app->user->identity) {
            return $this->redirect(['/prize/index']);
        }
        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/prize/index']);
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        if ($id != Yii::$app->user->id) {
            throw new ForbiddenHttpException;
        }
        $model = Admin::findOne($id);
        if (!$model) {
            Yii::$app->session->setFlash('danger', '未找到该用户');
            return $this->redirect(['/prize/index']);
        }
        $model->load(Yii::$app->request->post());
        if (Yii::$app->request->isPost && $model->validate()) {

            $password = Yii::$app->request->post('Admin')['password'];
            $admin_name = Yii::$app->request->post('Admin')['admin_name'];
            if (!empty($password)) {
                $model->setPassword($password);
                $model->admin_name = $admin_name;
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '成功更新用户“'.$model->admin_name.'”。');
                return $this->redirect(['/admin/logout']);
            } else {
                Yii::$app->session->setFlash('danger', '更新用户失败。');
                return $this->redirect(['/prize/index']);
            }
        }

        $model->password = '';
        return $this->render('update', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/admin/login']);
    }
}
