<?php

namespace modules\event\models;

use Yii;
use modules\user\models\User;
use modules\event\models\Event;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property integer $id
 * @property integer $idUserReviewer
 * @property integer $idUserReviewing
 * @property integer $idEvent
 * @property string $text
 * @property integer $ratingAmount
 *
 * @property Event $idEvent0
 * @property User $idUserReviewer0
 * @property User $idUserReviewing0
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUserReviewer', 'idUserReviewing', 'idEvent', 'ratingAmount'], 'integer'],
            [['text'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('event', 'ID'),
            'idUserReviewer' => Yii::t('event', 'Id User Reviewer'),
            'idUserReviewing' => Yii::t('event', 'Id User Reviewing'),
            'idEvent' => Yii::t('event', 'Id Event'),
            'text' => Yii::t('event', 'Text'),
            'ratingAmount' => Yii::t('event', 'Rating Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserReviewer()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserReviewer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserReviewing()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserReviewing']);
    }
}
