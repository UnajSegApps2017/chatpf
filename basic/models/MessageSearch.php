<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message;

/**
 * MessageSearch represents the model behind the search form about `app\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMessage', 'messagedelievered'], 'integer'],
            [['headderMessage', 'messageContent'], 'safe'],
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
        $query = Message::find();
        // add conditions that should always apply here
        //$query->andFilterWhere(['idUser' => Yii::$app->user->identity->idUser]);
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
            'idMessage' => $this->idMessage,
            'messagedelievered' => $this->messagedelievered,
        ]);

        $query->andFilterWhere(['like', 'headderMessage', $this->headderMessage])
            ->andFilterWhere(['like', 'messageContent', $this->messageContent]);

        return $dataProvider;
    }
}
