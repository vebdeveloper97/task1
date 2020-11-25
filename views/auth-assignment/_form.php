<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\AuthItem;


/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'item_name')->widget(Select2::class, [
                'data' => ArrayHelper::map(AuthItem::find()->all(),'name', 'name'),
                'options' => [
                    'placeholder' => Yii::t('app', 'Select...'),
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'user_id')->widget(Select2::class,[
                'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'options' => [
                    'placeholder' => Yii::t('app', 'User Select'),
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
