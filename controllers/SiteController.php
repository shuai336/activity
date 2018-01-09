<?php

namespace app\controllers;

use app\models\Prize;
use app\models\PrizeToUser;
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
        $user_id = 1;

        $prize = $this->get_prize_random($user_id);
        return $this->render('prize');
    }

    //整理奖品信息，并进行抽奖
    public function get_prize_random($user_id)
    {
        $user_today_game_num = PrizeToUser::find()->where(['data' => date('Y-m-d', time()), 'user_id' => $user_id])->asArray()->all();
        //判断用户今日抽奖次数
        if ( count($user_today_game_num) >= 3 ) {
            $result = 'You have no chance to play the game today.';
            return $result;
        }

        $prize = Prize::find()->select(['id', 'prize_name', 'value', 'role', 'weight'])->where('rest > 0')->asArray()->all();
        $prize_weight = [];
        $weight_total = 0;
        foreach ($prize as $k => $v) {
            $prize_weight[$v['prize_name']] = (int)$v['weight'];
            $weight_total += (int)$v['weight'];
        }
        $weight_len = strlen($weight_total);
        $nothing_weight = pow(10, $weight_len) - $weight_total;
        $prize_weight['没中奖'] = $nothing_weight;

        $prize_name = $this->roll($prize_weight);
        return ;
    }
    /**
     * 抽奖算法
     * @param array $weight 权重 例如array('a'=>200,'b'=>300,'c'=>500)
     * @return string key 键名
     */
    function roll($weight = array()) {
        $roll = rand ( 1, array_sum ( $weight ) );
        $_tmpW = 0;
        $prize_name = 0;
        foreach ( $weight as $k => $v ) {
            $min     = $_tmpW;
            $_tmpW += $v;
            $max     = $_tmpW;
            if ($roll > $min && $roll <= $max) {
                $prize_name = $k;
                break;
            }
        }
        return $prize_name;
    }
}
