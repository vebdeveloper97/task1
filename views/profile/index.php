<?php

use yii\helpers\Html;
use yii\helpers\Url;

    /* @var $model \app\models\HrEmployee */

?>
<div class="container">

    <div class="row print">
        <div class="col-lg-11">
            <table class="table table-bordered">
                <thead>
                <th><?=Yii::t('app', 'My Images')?></th>
                <th><?=Yii::t('app', 'FISH')?></th>
                <th><?=Yii::t('app', 'Email')?></th>
                <th><?=Yii::t('app', 'Phone')?></th>
                <th><?=Yii::t('app', 'Brith Date')?></th>
                <th><?=Yii::t('app', 'Username')?></th>
                </thead>
                <tbody>
                <td><img src="/uploads/<?=$model->images?>" style="width: 150px" alt=""></td>
                <td><?=$model->fish?></td>
                <td><?=$model->email?></td>
                <td><?=$model->phone?></td>
                <td><?php
                        $date = strtotime($model->brith_date);
                        $newDate = date('m.d.Y', $date);
                        echo $newDate;
                    ?></td>
                <td><?=\app\models\User::findOne($model->user_id)->username?></td>
                </tbody>
            </table>
        </div>
    </div>
</div>
