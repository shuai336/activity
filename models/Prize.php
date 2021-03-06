<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prize".
 *
 * @property int $id
 * @property string $prize_name
 * @property string $value
 * @property int $role
 * @property int $number
 * @property int $rest
 * @property int $weight
 */
class Prize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prize';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'number', 'rest'], 'integer'],
            ['weight', 'number'],
            [['prize_name', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prize_name' => '奖品名称',
            'value' => '奖品价值',
            'role' => 'role',
            'number' => '总量',
            'rest' => '剩余数量',
            'weight' => '权重',
        ];
    }
}
