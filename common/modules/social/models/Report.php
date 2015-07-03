<?php

namespace modules\social\models;

use Yii;
use modules\user\models\User;
use modules\social\models\ReportReason;
use modules\social\models\Reason;
/**
 * This is the model class for table "{{%report}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property string $text
 *
 * @property User $idUser
 * @property ReportReason[] $reportReasons
 * @property Reason $reason
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%report}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser'], 'integer'],
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
            'idUser' => Yii::t('social', 'Id User'),
            'text' => Yii::t('social', 'Text'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportReason()
    {
        return $this->hasOne(ReportReason::className(), ['idReport' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReason()
    {
        return $this->hasOne(Reason::className(), ['id' => 'idReason'])->via('reportReasons');
    }
}
