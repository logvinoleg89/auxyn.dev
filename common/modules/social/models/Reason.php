<?php

namespace modules\social\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\social\models\ReportReason;
use modules\social\models\Report;

/**
 * This is the model class for table "{{%reason}}".
 *
 * @property integer $id
 * @property string $text
 * @property integer $type
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property ReportReason[] $reportReasons
 * @property Report $report
 */
class Reason extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reason}}';
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
            [['text', 'createdAt', 'updatedAt'], 'required'],
            [['type', 'createdAt', 'updatedAt'], 'integer'],
            [['text'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'text' => Yii::t('social', 'Text'),
            'type' => Yii::t('social', 'Type'),
            'createdAt' => Yii::t('social', 'Created At'),
            'updatedAt' => Yii::t('social', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportReasons()
    {
        return $this->hasMany(ReportReason::className(), ['idReason' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReport()
    {
        return $this->hasOne(Report::className(), ['id' => 'idReport'])->via('reportReasons');
    }
}
