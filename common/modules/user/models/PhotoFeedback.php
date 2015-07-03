<?php

namespace modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\Feedback;
use modules\user\models\PhotoFeedback;

/**
 * This is the model class for table "{{%photoFeedback}}".
 *
 * @property integer $id
 * @property integer $idFeedback
 * @property integer $idPhoto
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Photo $photo
 * @property Feedback $feedback
 */
class PhotoFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photoFeedback}}';
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
            [['idFeedback', 'idPhoto', 'createdAt', 'updatedAt'], 'required'],
            [['idFeedback', 'idPhoto', 'createdAt', 'updatedAt'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'idFeedback' => Yii::t('user', 'Id Feedback'),
            'idPhoto' => Yii::t('user', 'Id Photo'),
            'createdAt' => Yii::t('user', 'Created At'),
            'updatedAt' => Yii::t('user', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'idPhoto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedback()
    {
        return $this->hasOne(Feedback::className(), ['id' => 'idFeedback']);
    }
}
