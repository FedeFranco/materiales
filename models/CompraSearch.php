<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Compra;

/**
 * CompraSearch represents the model behind the search form about `app\models\Compra`.
 */
class CompraSearch extends Compra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productos_id', 'clientes_id'], 'integer'],
            [['precio'], 'number'],
            [['productos_id','clientes_id'],'safe'],
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
        $query = Compra::find()->joinWith('productos')->joinWith('clientes');
        //var_dump($query); die();

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


        $dataProvider->sort->attributes['productos_id'] = [
            'asc' => ['productos.nombre_producto' => SORT_ASC],
            'desc' => ['personas.nombre_producto' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['clientes_id'] = [
            'asc' => ['clientes.nombre_cliente' => SORT_ASC],
            'desc' => ['clientes.nombre_cliente' => SORT_DESC],
        ];

        $query->
        andFilterWhere(['ilike', 'productos.nombre_producto', $this->productos_id])->
        andFilterWhere(['ilike', 'clientes.nombre_cliente', $this->clientes_id]);

        // grid filtering conditions
        /*$query->andFilterWhere([
            'id' => $this->id,
            'productos_id' => $this->productos_id,
            'clientes_id' => $this->clientes_id,
            'precio' => $this->precio,
        ]);*/

        return $dataProvider;
    }
}
