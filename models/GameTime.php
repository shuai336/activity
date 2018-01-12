<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_time".
 *
 * @property int $id
 * @property int $game_time
 */
class GameTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_time' => '每日游戏次数',
        ];
    }
}
