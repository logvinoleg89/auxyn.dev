<?php

namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use modules\user\models\User;
use modules\photo\models\Photo;
use modules\user\models\PhotoFeedback;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property integer $idUser
 * @property string $text
 * @property string $location
 *
 * @property User $user
 * @property Photo $photo
 * @property PhotoFeedback[] $photoFeedbacks
 */
class Feedback extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser'], 'integer'],
            [['text', 'location'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'idUser' => Yii::t('user', 'Id User'),
            'text' => Yii::t('user', 'Text'),
            'location' => Yii::t('user', 'Location'),
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
    public function getPhotoFeedbacks()
    {
        return $this->hasMany(PhotoFeedback::className(), ['idFeedback' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'idPhoto'])->via('photoFeedbacks');
    }
}
