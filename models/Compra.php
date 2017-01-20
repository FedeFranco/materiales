<?php

namespace app\models;

use Yii;
use app\models\Cliente;
use app\models\Producto;

/**
 * This is the model class for table "compras".
 *
 * @property integer $id
 * @property integer $productos_id
 * @property integer $clientes_id
 * @property string $precio
 *
 * @property Clientes $clientes
 * @property Productos $productos
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productos_id', 'clientes_id', 'precio'], 'required'],
            [['productos_id', 'clientes_id'], 'integer'],
            [['precio'], 'number'],
            [['clientes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['clientes_id' => 'id']],
            [['productos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['productos_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productos_id' => 'Productos ID',
            'clientes_id' => 'Clientes ID',
            'precio' => 'Precio',
        ];
    }

    public function comprar($producto,$cliente,$precio)
    {
        $this->clientes_id = Cliente::find()
        ->select('id')
        ->where(['nombre_cliente'=>$cliente]);

        var_dump($this->clientes_id); die();
        $producto = Producto::find()
        ->select('id')
        ->where(['nombre_producto'=>$producto])
        ->one();



        $this->productos_id = $producto->id;
        $this->precio = $precio;
        $this->save();
        return true;

    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'clientes_id'])->inverseOf('compras');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasOne(Producto::className(), ['id' => 'productos_id'])->inverseOf('compras');
    }

    public function getTotal()
    {
        $do = [];
        $ides = Cliente::find()->select('id')->asArray()->all();
        foreach ($ides as $id) {
            $do[] = $this::find()->select('*')->where(['clientes_id'=>$id])->sum('precio');
        }
        return $do;
    }

    public function pruebaFind()
    {
        $prueba = $this::findOne(2)->precio;
        var_dump($prueba); die();
        return $prueba;
    }


}
