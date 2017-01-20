<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Compras</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model,'producto'); ?>
    <?=$form->field($model,'cliente'); ?>
    <?=$form->field($model,'precio'); ?>

    <?=Html::submitButton('Comprar',['class'=>'btn btn-success']); ?>

    <?php $form = ActiveForm::end();?>
