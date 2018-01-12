<?php

namespace app\controllers;

use app\models\GameTime;
use app\models\Prize;
use app\models\PrizeToUser;
use app\models\UserInfo;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

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

    //首页 进行授权
    public function actionIndex()
    {
        $client_id = Yii::$app->params['client_id'];
        $aid = Yii::$app->params['aid'];
        $redirect_uri = Yii::$app->params['redirect_uri'];
        $url = "https://dopen.weimob.com/fuwu/c/oauth2/authorize?enter=wx&view=wx&aid=$aid&response_type=code&scope=default&client_id=$client_id&redirect_uri=$redirect_uri";
        header("Location:$url");
    }

    //获取 access_token
    public function actionCode()
    {
        //获取 code
        $code = Yii::$app->request->get('code');

        if (!$code) {
//            return $this->redirect('index');
        }
        //获取access_token openid
//        $access_token_arr = $this->get_access_token($code);
//        $access_token = $access_token_arr['access_token'];
//        $openid = $access_token_arr['openId'];

        //判断是否关注公众号，没关注的话跳转关注
//        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
//        $wechat_user_info = $this->send_get($url);
//        $is_subscribe = $wechat_user_info['subscribe'];
//        if (!$is_subscribe) {
//            return $this->redirect('');
//        }

        //保存用户信息
//        $user = $this->get_user_nick_name($access_token);
//        $user_info = new UserInfo();
//        $user_info->openid = $openid;
//        $user_info->access_token = $access_token;
//        $user_info->username = $user['NickName'];
//        $user_info->region = $user['City'];
//        $user_info->head_imgurl = $user['HeadimgUrl'];
//        $user_info->save();

        $openid = 1234567;
        $session = Yii::$app->session;
        $session->set('openid', $openid);

        //跳转到抽奖页面
        return $this->redirect('prize');
    }

    //请求抽奖 ， 渲染抽奖页面
    public function actionPrize()
    {
        $session = Yii::$app->session;
        $openid = $session->get('openid');
        if (!$openid) {
            return $this->redirect('index');
        }

        //获取用户信息
        $user = UserInfo::find()->where(['openid' => $openid])->asArray()->one();
        $user_name = $user['username'];
        $user_id = $user['id'];
        $user_headimgurl = $user['head_imgurl'];
        
        //剩余游戏次数
        $max_game_time = GameTime::findOne(1)->game_time;
        $time = date('Y-m-d H:i:s');
        $game_time = PrizeToUser::find()->where(['date' => date('Y-m-d', time()), 'user_id' => $user_id])->count();
        $rest_time = $max_game_time - $game_time;

        //获取参加活动人数
        $user_count = UserInfo::find()->count();

        //获取中奖列表 进行展示
        $prize_to_user = PrizeToUser::get_prize_to_user();

        if (UserInfo::find()->where(['openid' => $openid])->exists()) {
            return $this->render('prize',
                [
                    'prize_to_user' => $prize_to_user,
                    'user_name' => $user_name,
                    'user_count' => $user_count,
                    'rest_time' => $rest_time <= 0 ? 0 :$rest_time,
                    'head_imgurl' => $user_headimgurl,
                ]);
        } else {
            return $this->redirect('code');
        }
    }

    //抽奖， 并返回json -> ajax
    public function actionGetPrize()
    {
//        if (Yii::$app->request->isAjax) {
        if (1){
            $session = Yii::$app->session;
            $openid = $session->get('openid');
//            $openid = '1234567';
            if (!$openid) {
                return $this->redirect('index');
            }
            $user_id = UserInfo::find()->where(['openid' => $openid])->one()->id;
            $prize = $this->get_prize_random($user_id);
            $json = json_encode($prize);
            return json_encode($prize);
        }
    }

    //获取中奖信息进行展示  返回json -> ajax
//    public function actionShowUserPrize()
//    {
//        $prize_to_user = PrizeToUser::get_prize_to_user();
//
//        if (Yii::$app->request->isAjax) {
//            return json_encode($prize_to_user);
//        }
//    }

    //获取 access_token 相关信息
    public function get_access_token($code)
    {
        $client_id = Yii::$app->params['client_id'];
        $redirect_uri = Yii::$app->params['redirect_uri'];
        $client_secret = Yii::$app->params['client_secret'];
        $post_data = array(
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
        );
        $access_token_url = "https://dopen.weimob.com/fuwu/c/oauth2/token";
        $access_token_arr = $this->send_post($access_token_url, $post_data);

        return $access_token_arr;
    }

    //获取用户信息
    public function get_user_info($access_token)
    {
        $user_url = "https://dopen.weimob.com/c/api/1_0/oauthcenter/session/getuserinfo";
        $user_post_data = array(
            'accesstoken' => $access_token,
        );
        $user = $this->send_post($user_url, $user_post_data);

        return $user;
    }

    //整理奖品信息，并进行抽奖
    public function get_prize_random($user_id)
    {
        $max_game_time = GameTime::findOne(1)->game_time;
        $prize_id_role_1 = array();
        $user_today_prize_id = array();
        $user_today_game = PrizeToUser::find()->where(['date' => date('Y-m-d', time()), 'user_id' => $user_id])->asArray()->all();
        $rest_time = $max_game_time - count($user_today_game);

        //判断用户今日抽奖次数
        if ( $rest_time <= 0 ) {
            $user_got_prize['prize_name'] = '没次数';
            $user_got_prize['rest_time'] = 0;
            return $user_got_prize;
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

        //保存中奖信息
        $prize_to_user = new PrizeToUser();
        $prize_to_user->prize_id = $prize_id;
        $prize_to_user->user_id = $user_id;
        $prize_to_user->date = date('Y-m-d', time());
        $prize_to_user->save();

        if ($prize_id == 0) {
            $user_got_prize['prize_name'] = '没中奖';
            $user_got_prize['rest_time'] = $rest_time <= 0 ? 0 : $rest_time-1;
            return $user_got_prize;
        }
        //修改奖品剩余量
        $update_prize = Prize::findOne($prize_id);
        $update_prize->rest = $update_prize->rest -1;
        $update_prize->save();

        $user_got_prize = array('prize_name' => $prize_info[$prize_id]['prize_name'], 'value' => $prize_info[$prize_id]['value']);
        $user_got_prize['rest_time'] = $rest_time <= 0 ? 0 : $rest_time-1;
        return $user_got_prize;
    }

    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param array $post_data post键值对数据
     * @return string
     */
    public function send_post($url, $post_data) {

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

    //发送get请求
    public function send_get($url)
    {
        $result = file_get_contents($url);
        return $result;
    }

    /**
     * 抽奖算法
     * @param array $weight 权重 例如array('a'=>200,'b'=>300,'c'=>500)
     * @return string key 键名
     */
    public function roll($weight = array()) {
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

    public function actionTestAjax()
    {
        return $this->render('index');
    }
}
