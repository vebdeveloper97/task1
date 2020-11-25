<?php


namespace app\controllers;


use app\models\HrEmployee;
use kartik\mpdf\Pdf;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

class ProfileController extends AuthController
{
    public function beforeAction($action)
    {
        if(\Yii::$app->user->can('simple')){
            return parent::beforeAction($action);
        }
        else{
            throw new ForbiddenHttpException(\Yii::t('app', 'Access denied!'),400);
        }
    }

    public function actionIndex()
    {
        $model = HrEmployee::findOne(['user_id' => \Yii::$app->user->id]);
        if($model){
            return $this->render('index', [
                'model' => $model
            ]);
        }
        else{
            throw new HttpException(404,\Yii::t('app', 'Not Found'));
        }
    }


}