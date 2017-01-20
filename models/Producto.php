<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property integer $id
 * @property string $nombre_producto
 *
 * @property Compras[] $compras
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_producto'], 'required'],
            [['nombre_producto'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_producto' => 'Nombre Producto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['productos_id' => 'id'])->inverseOf('productos');
    }
}
