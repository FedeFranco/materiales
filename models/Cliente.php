<?php

namespace app\models;

use Yii;
use app\models\Compra;

/**
 * This is the model class for table "clientes".
 *
 * @property integer $id
 * @property string $nombre_cliente
 * @property string $edad
 *
 * @property Compras[] $compras
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_cliente'], 'required'],
            [['edad'], 'number'],
            [['nombre_cliente'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_cliente' => 'Nombre Cliente',
            'edad' => 'Edad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['clientes_id' => 'id'])->inverseOf('clientes');
    }

    public function getComprado()
    {
        $h = $this->getCompras()->select('clientes_id')->scalar();
        var_dump($h); die();
        return $h;
    }
}
