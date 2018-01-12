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
    public $prize_name;
    public $username;
    public $region;
    public $phone;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date'], 'safe'],
            [['prize_name', 'username', 'region', 'phone'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PrizeToUser::find()->where('prize_to_user.prize_id <> 0');
        $query->joinWith(['prize'])
            ->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['date' => SORT_DESC]],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'date',
                'username',
                'region',
                'phone',
                'prize_name',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'date', $this->date]);
        $query->andFilterWhere(['like', 'prize.prize_name', $this->prize_name]);
        $query->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'user.region', $this->region])
            ->andFilterWhere(['like', 'user.phone', $this->phone]);

        return $dataProvider;
    }
}
