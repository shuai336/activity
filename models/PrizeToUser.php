<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prize_to_user".
 *
 * @property int $id
 * @property int $prize_id
 * @property int $user_id
 * @property string $date
 */
class PrizeToUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prize_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prize_id', 'user_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'username',
            'phone' => 'phone',
            'prize_name' => 'prize_name',
            'date' => '日期',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(UserInfo::className(), ['id' => 'user_id']);
    }

    public function getPrize()
    {
        return $this->hasOne(Prize::className(), ['id' => 'prize_id']);
    }

    public static function get_prize_to_user()
    {
        $prize_to_user = self::find()
            ->select(['user.username', 'user.region', 'prize.prize_name'])
            ->where('prize_to_user.prize_id <> 0')
            ->leftJoin('user', 'user.id = prize_to_user.user_id')
            ->leftJoin('prize', 'prize.id = prize_to_user.prize_id')
            ->asArray()->all();

        return $prize_to_user;
    }
}
