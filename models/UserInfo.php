<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $phone
 * @property string $region
 * @property string $openid
 * @property string $access_token
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'phone', 'region', 'openid', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '微信名',
            'phone' => '联系方式',
            'region' => '地区',
            'openid' => 'Openid',
            'access_token' => 'Access Token',
        ];
    }
}
