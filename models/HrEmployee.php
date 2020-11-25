<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "hr_employee".
 *
 * @property int $id
 * @property string $fish
 * @property string|null $email
 * @property string $phone
 * @property string $pasport_series
 * @property string|null $images
 * @property string $brith_date
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class HrEmployee extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hr_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fish', 'phone', 'pasport_series', 'brith_date'], 'required'],
            [['brith_date'], 'safe'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['fish', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['pasport_series'], 'string', 'max' => 25],
            [['images'], 'string', 'max' => 255],
            [['user_id'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fish' => Yii::t('app', 'Fish'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'pasport_series' => Yii::t('app', 'Pasport Series'),
            'images' => Yii::t('app', 'Images'),
            'brith_date' => Yii::t('app', 'Brith Date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                if(!empty($this->brith_date)){
                    $time = strtotime($this->brith_date);
                    $this->brith_date = date('Y-m-d', $time);
                }

                if(empty($this->status)){
                    $this->status = $this::STATUS_ACTIVE;
                }
            }
            return true;
        }
        else{
            return false;
        }
    }

    public function upload()
    {
        if (!$this->validate()) {
            $this->images->saveAs('uploads/' . $this->images->baseName . '.' . $this->images->extension);
            return true;
        } else {
            return false;
        }
    }
}
