<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Userchat;

/**
 * UserchatSearch represents the model behind the search form about `app\models\Userchat`.
 */
class UserchatSearch extends Userchat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'activUser'], 'integer'],
            [['nameUser', 'passwordUser', 'publicKeyUser', 'mailUser', 'authkeyUser'], 'safe'],
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
        $query = Userchat::find();

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
            'idUser' => $this->idUser,
            'activUser' => $this->activUser,
        ]);

        $query->andFilterWhere(['like', 'nameUser', $this->nameUser])
            ->andFilterWhere(['like', 'passwordUser', $this->passwordUser])
            ->andFilterWhere(['like', 'publicKeyUser', $this->publicKeyUser])
            ->andFilterWhere(['like', 'mailUser', $this->mailUser])
            ->andFilterWhere(['like', 'authkeyUser', $this->authkeyUser]);

        return $dataProvider;
    }
}
