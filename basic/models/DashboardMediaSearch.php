<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DashboardMedia;

/**
 * DashboardMediaSearch represents the model behind the search form about `app\models\DashboardMedia`.
 */
class DashboardMediaSearch extends DashboardMedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_media', 'id_autor'], 'integer'],
            [['filename', 'fecha', 'extencion'], 'safe'],
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
        $query = DashboardMedia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_media' => $this->id_media,
            'id_autor' => $this->id_autor,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'extencion', $this->extencion]);

        return $dataProvider;
    }
}
