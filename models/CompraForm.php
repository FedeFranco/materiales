<?php
namespace app\models;

use yii\base\Model;

class CompraForm extends Model
{
    public $producto;
    public $cliente;
    public $precio;

    function rules()
    {
        return [
            [['producto','cliente','precio'],'required'],
            [['precio'],'number'],
            /*[['clientes_id'], 'exist',
            'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['nombre_producto' => 'producto']],
            [['productos_id'], 'exist',
            'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['nombre_cliente' => 'cliente']],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'cliente'=>'Nombre Cliente',
            'producto'=>'Nombre Producto',
            'precio'=>'Precio',

        ];
    }


}
