<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $hr \app\models\HrEmployee */
/* @var $arrayImg []*/
$img = isset($arrayImg)?$arrayImg:[];
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?=$form->field($hr, 'images')->widget(FileInput::class,[
                'name' => 'attachment_52',
                'pluginOptions' => [
                    'browseClass' => 'btn btn-success',
                    'uploadClass' => 'btn btn-info',
                    'removeClass' => 'btn btn-danger',
                    'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                    'initialPreview' => $img
                ]
            ])?>
        </div>
        <div class="col-lg-3">
            <?=$form->field($hr, 'fish')?>
        </div>
        <div class="col-lg-3">
            <?=$form->field($hr, 'phone')->widget(\yii\widgets\MaskedInput::class,[
                'mask' => '(999) 999-99-99'
            ])?>
        </div>
        <div class="col-lg-3">
            <?=$form->field($hr, 'pasport_series')->widget(\yii\widgets\MaskedInput::class,[
                'mask' => 'AA-9999999'
            ])?>
        </div>
        <div class="col-lg-3">
            <?=$form->field($hr, 'email')->widget(\yii\widgets\MaskedInput::class,[
                'clientOptions' => [
                    'alias' =>  'email'
                ],
            ])?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($hr,'brith_date')->widget(\kartik\date\DatePicker::class,[
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ])?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="form-group">

    </div>

    <?php ActiveForm::end(); ?>

</div>
