<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PrizeToUser;

/**
 * PrizeToUserSearch represents the model behind the search form of `app\models\PrizeToUser`.
 */
class PrizeToUserSearch extends PrizeToUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'phone', 'prize_name'], 'string'],
            [['data'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
//    public function scenarios()
//    {
//        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PrizeToUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }

        // grid filtering conditions
        $query->select(['user.username as username', 'replace(user.phone, substr(user.phone, 4, 4), "****") as phone', 'prize.prize_name as prize_name'])
            ->where('prize_to_user.prize_id <> 0')
            ->leftJoin('user', 'user.id = prize_to_user.user_id')
            ->leftJoin('prize', 'prize.id = prize_to_user.prize_id');

        return $dataProvider;
    }
}