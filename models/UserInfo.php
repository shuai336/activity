<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $openid
 * @property string $access_token
 * @property string $username
 * @property string $phone
 * @property string $region
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
            [['openid', 'access_token', 'username', 'region'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'access_token' => 'Access Token',
            'username' => 'Username',
            'phone' => 'Phone',
            'region' => 'Region',
        ];
    }
}
