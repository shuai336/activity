<?php

namespace app\controllers;

use app\models\Prize;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPrize()
    {
        $query = Prize::find();
        $prize = $query->select(['id', 'prize_name', 'value', 'role'])->where('rest > 0')->asArray()->all();
        return $this->render('prize');
    }

    public function get_prize_random()
    {
        $prize = Prize::find()->select(['id', 'prize_name', 'value', 'role'])->where('rest > 0')->asArray()->all();
        
        $prize_index = array_rand($prize);

    }
    /**
     * @param array $weight 权重 例如array('a'=>200,'b'=>300,'c'=>500)
     * @return string key 键名
     */
    function roll($weight = array()) {
        $roll = rand ( 1, array_sum ( $weight ) );
        // echo $roll."<br>";
        $_tmpW = 0;
        $rollnum = 0;
        foreach ( $weight as $k => $v ) {
            $min     = $_tmpW;
            $_tmpW += $v;
            $max     = $_tmpW;
            if ($roll > $min && $roll <= $max) {
                $rollnum = $k;
                break;
            }
        }
        return $rollnum;
    }
}
