<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use kartik\select2\Select2;
use app\models\AuthAssignment;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-child-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'parent')->widget(Select2::class,[
                'data' => ArrayHelper::map(AuthAssignment::find()->all(), 'item_name', 'item_name'),
                'options' => [
                    'placeholder' => Yii::t('app', 'Select Parent'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'child')->widget(Select2::class,[
                'data' => ArrayHelper::map(AuthAssignment::find()->all(), 'item_name', 'item_name'),
                'options' => [
                    'placeholder' => Yii::t('app', 'Select Child'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
