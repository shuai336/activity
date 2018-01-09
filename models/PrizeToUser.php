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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prize_id' => 'Prize ID',
            'user_id' => 'User ID',
            'data' => 'Data',
        ];
    }
}
