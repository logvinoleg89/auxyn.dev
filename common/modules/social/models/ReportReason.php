<?php

namespace modules\social\models;

use Yii;
use modules\social\models\Reason;
use modules\social\models\Report;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%reportReason}}".
 *
 * @property integer $id
 * @property integer $idReason
 * @property integer $idReport
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Reason $idReason
 * @property Report $idReport
 */
class ReportReason extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reportReason}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idReason', 'idReport', 'createdAt', 'updatedAt'], 'required'],
            [['idReason', 'idReport', 'createdAt', 'updatedAt'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'idReason' => Yii::t('social', 'Id Reason'),
            'idReport' => Yii::t('social', 'Id Report'),
            'createdAt' => Yii::t('social', 'Created At'),
            'updatedAt' => Yii::t('social', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReason()
    {
        return $this->hasOne(Reason::className(), ['id' => 'idReason']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReport()
    {
        return $this->hasOne(Report::className(), ['id' => 'idReport']);
    }
}
