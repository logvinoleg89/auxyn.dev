<?php

namespace modules\photo\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\message\models\Message;
use modules\user\models\PhotoFeedback;
use modules\user\models\PhotoUser;
use modules\social\models\SocialRelations;
use modules\user\models\Timeline;
use modules\user\models\User;
use modules\user\models\Feedback;
use modules\social\models\Comment;
use modules\social\models\Like;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property integer $id
 * @property string $file
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Message[] $message
 * @property PhotoFeedback[] $photoFeedbacks
 * @property PhotoUser[] $photoUsers
 * @property SocialRelations[] $socialRelations
 * @property Timeline[] $timelines
 * @property User[] $users
 * @property Feedback[] $feedback
 * @property UserPhotos[] $userPhotos
 * @property Comments[] $Comments
 * @property Likes[] $likes
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
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
            [['file', 'createdAt', 'updatedAt'], 'required'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['file'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('photo', 'ID'),
            'file' => Yii::t('photo', 'File'),
            'createdAt' => Yii::t('photo', 'Created At'),
            'updatedAt' => Yii::t('photo', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['idPhoto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoFeedbacks()
    {
        return $this->hasMany(PhotoFeedback::className(), ['idPhoto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoUsers()
    {
        return $this->hasMany(PhotoUser::className(), ['idPhoto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialRelations()
    {
        return $this->hasMany(SocialRelations::className(), ['idPhoto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimelines()
    {
        return $this->hasMany(Timeline::className(), ['idPhoto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['mainPhoto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['id' => 'idFeedback'])->via('photoFeedbacks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPhotos()
    {
        return $this->hasMany(User::className(), ['id' => 'idUser'])->via('photoFeedbacks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['id' => 'idComment'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['id' => 'idLike'])->via('socialRelations');
    }
}
