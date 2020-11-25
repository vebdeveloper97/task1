<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $hr \app\models\HrEmployee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $hr->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $hr->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $hr,
        'attributes' => [
            'id',
            'fish',
            'email:email',
            'phone',
            'pasport_series',
            [
                'attribute' => 'images',
                'value' => function($model){
                    return "<img style='width:70px' height='70px' src='/uploads/".$model->images."'>";
                },
                'format' => 'html'
            ],
            'brith_date',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            [
               'attribute' => 'user_id',
               'value' => function($model){
                    $user =  \app\models\User::findOne($model->user_id);
                    return $user->username;
               }
            ],
        ],
    ]) ?>

</div>
