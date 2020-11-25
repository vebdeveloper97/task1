<?php

namespace app\controllers;

use app\models\HrEmployee;
use app\models\HrEmployeeSearch;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AuthController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if(Yii::$app->user->can('settings')){
            return parent::beforeAction($action);
        }
        else{
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied!'), '400');
        }
    }

    /**
     * Lists all HrEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HrEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $hr = HrEmployee::findOne(['user_id' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'hr' => $hr,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $hr = new HrEmployee();

        if ($model->load(Yii::$app->request->post()) && $hr->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $saved = false;
            try{
                $hr->images = UploadedFile::getInstance($hr, 'images');
                if($hr->upload()){
                    $saved = true;
                }
                else{
                    $saved = false;
                }
                $model->password = md5($model->password);
                $saved = $model->save() && $saved;

                $hr->user_id = $model->id;
                $hr->images = $hr->images->name;
                $saved = $hr->save() && $saved;

                if($saved){
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Success Saved'));
                    return $this->redirect(['user/view', 'id' => $model->id]);
                }
                else{
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Not Saved'));
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
            catch (\Exception $e){
                Yii::info('Error message '.$e->getMessage(),'save');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'hr' => $hr
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $hr = HrEmployee::findOne(['id' => $id]);
        $model = $this->findModel($hr->user_id);
        $arrayImg = ['/uploads/'.$hr->images];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'hr' => $hr,
            'arrayImg' => $arrayImg
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $hr = HrEmployee::findOne($id);
        $this->findModel($hr->user_id)->delete();
        $hr->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
