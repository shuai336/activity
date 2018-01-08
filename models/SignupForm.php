<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $admin_name;
    public $password;

    public function rules()
    {
        return [
            ['admin_name', 'filter', 'filter' => 'trim'],
            ['admin_name', 'required','message' => '用户名不能为空'],
            ['admin_name', 'unique', 'targetClass' => 'app\models\Admin', 'message' => '用户名已存在'],
            ['admin_name', 'string', 'min' => 2, 'max' => 255],


            ['password', 'required','message' => '密码不能为空'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new Admin();
            $user->admin_name = $this->admin_name;
            $user->setPassword($this->password);
            $user->create_time = date('Y-m-d H:i:s', time());
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
}