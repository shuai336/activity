<?php

namespace app\controllers;

use app\models\Prize;
use app\models\PrizeToUser;
use app\models\UserInfo;
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

    //首页
    public function actionIndex()
    {
//        $code = $this->get_authorization();
        return $this->render('code', ['code' => '123']);
    }

    public function actionCode()
    {
        $code = $_GET['code'];
    }

    public function actionPrize()
    {
        $user_id = 1;

        $prize = $this->get_prize_random($user_id);
        return $this->render('prize');
    }

    public function actionShowPrize()
    {
        $prize = $this->show_user_prize();
        return;
    }

    public function get_authorization()
    {
        //获取code
        $client_id = '';
        $aid = '';
        $redirect_uri = '';
        $url = "https://dopen.weimob.com/fuwu/c/oauth2/authorize?enter=wx&view=wx&aid=$aid&response_type=code&scope=default&client_id=$client_id&redirect_uri=$redirect_uri";
        header("Location:$url");
        $code = $_GET['code'];

        return ;
    }

    //获取 access_token
    public function get_access_token()
    {
        $client_id = '';
        $code = '';
        $redirect_uri = '';
        $client_secret = '';
        $post_data = array(
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
        );
        $access_token_url = "https://dopen.weimob.com/fuwu/c/oauth2/token";
        $get_access_token = $this->send_post($access_token_url, $post_data);
        $access_token = $get_access_token['access_token'];

        return $access_token;
    }

    //获取用户信息
    public function get_user($access_token)
    {
        $user_url = "https://dopen.weimob.com/c/api/1_0/oauthcenter/session/getuserinfo";
        $user_post_data = array(
            'accesstoken' => $access_token,
        );
        $user = $this->send_post($user_url, $user_post_data);
    }

    //整理奖品信息，并进行抽奖
    public function get_prize_random($user_id)
    {
        $prize_id_role_1 = array();
        $user_today_prize_id = array();
        $user_today_game = PrizeToUser::find()->where(['data' => date('Y-m-d', time()), 'user_id' => $user_id])->asArray()->all();

        //判断用户今日抽奖次数
        if ( count($user_today_game) >= 3 ) {
            $result = 'You have no chance to play the game today.';
//            return $result;
        }
        //今日抽到奖品 id 列表
        if ($user_today_game) {
            foreach ($user_today_game as $item) {
                array_push($user_today_prize_id, $item['prize_id']);
            }
        }
        //获取 role 为 1 prize id
        $user_had_prize_role_1 = PrizeToUser::find()
            ->where(['user_id' => $user_id])
            ->leftJoin('prize', 'prize.id = prize_to_user.prize_id')
            ->where(['prize.role' => 1])
            ->asArray()->all();
        if ($user_had_prize_role_1) {
            foreach ($user_had_prize_role_1 as $item) {
                array_push($prize_id_role_1, $item['prize_id']);
            }
        }

        //获取可抽奖奖品
        $prize = Prize::find()
            ->select(['id', 'prize_name', 'value', 'weight'])
            ->where('rest > 0')
            ->andWhere(['not in', 'id', $prize_id_role_1])
            ->andWhere(['not in', 'id', $user_today_prize_id])
            ->asArray()->all();

        //整理奖品权重
        $prize_weight = array();
        $prize_info = array();
        $weight_total = 0;
        foreach ($prize as $k => $v) {
            $prize_weight[$v['id']] = (int)$v['weight'];
            $prize_info[$v['id']] = $v;
            $weight_total += (int)$v['weight'];
        }
        $weight_len = strlen($weight_total);
        $nothing_weight = pow(10, $weight_len) - $weight_total;
        $prize_weight[0] = $nothing_weight;

        //进行抽奖  获取奖品 id
        $prize_id = $this->roll($prize_weight);
        if ($prize_id == 0) {
            $result = '没抽中';
//            return $result;
        }

        //保存中奖信息
//        $prize_to_user = new PrizeToUser();
//        $prize_to_user->prize_id = $prize_id;
//        $prize_to_user->user_id = $user_id;
//        $prize_to_user->data = date('Y-m-d', time());
//        $prize_to_user->save();
//        //修改奖品剩余量
//        $update_prize = Prize::findOne($prize_id);
//        $update_prize->rest = $update_prize->rest -1;
//        $update_prize->save();

        $prize_id = 5;
        $user_got_prize = array('prize_name' => $prize_info[$prize_id]['prize_name'], 'value' => $prize_info[$prize_id]['value']);
        return ;
    }

    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param array $post_data post键值对数据
     * @return string
     */
    function send_post($url, $post_data) {

        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
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

    //获取中奖信息进行展示
    public function show_user_prize()
    {
        $prize_to_user = PrizeToUser::find()
            ->select(['user.username', 'replace(user.phone, substr(user.phone, 4, 4), "****") as phone', 'prize.prize_name'])
            ->leftJoin('user', 'user.id = prize_to_user.user_id')
            ->leftJoin('prize', 'prize.id = prize_to_user.prize_id')
            ->asArray()->all();

        return $prize_to_user;
    }
}
