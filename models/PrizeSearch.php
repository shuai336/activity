<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prize;

/**
 * PrizeSearch represents the model behind the search form of `app\models\Prize`.
 */
class PrizeSearch extends Prize
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role', 'number', 'rest'], 'integer'],
            ['weight', 'number'],
            [['prize_name', 'value'], 'safe'],
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
        $query = Prize::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_ASC]],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'role' => $this->role,
            'number' => $this->number,
            'rest' => $this->rest,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'prize_name', $this->prize_name])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
