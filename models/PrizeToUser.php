<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prize_to_user".
 *
 * @property int $id
 * @property int $prize_id
 * @property int $user_id
 * @property string $data
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
            [['data'], 'safe'],
            [['username', 'phone', 'prize_name']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
            'username' => 'username',
            'phone' => 'phone',
            'prize_name' => 'prize_name',
            'data' => 'Data',
        ];
    }

    public function getPrize()
    {
        
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
