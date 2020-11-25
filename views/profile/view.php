<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HrEmployee */

$this->title = $model->propertyId;
$this->params['breadcrumbs'][] = ['label' => 'Propertydetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="propertydetails-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<?= Html::a('Update', ['update', 'id' => $model->propertyId], ['class' => 'btn btn-primary']) ?>