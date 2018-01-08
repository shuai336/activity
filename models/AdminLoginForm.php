<?php
namespace app\models;

use Yii;
use yii\base\Model;

class AdminLoginForm extends Model
{
    public $username;
    public $password;
    private $_user;
    
    public function rules()
    {
        return [
            [['username'], 'required',
                'message'=>'用户名不能为空',
            ],
            [['password'], 'required',
                'message'=>'密码不能为空',
            ],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],

        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码不正确！');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }
}