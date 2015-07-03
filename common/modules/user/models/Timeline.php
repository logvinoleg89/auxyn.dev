<?php

namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use modules\social\models\SocialRelations;
use modules\user\models\User;
use modules\social\models\Comment;
use modules\social\models\Like;
use modules\social\models\Share;

/**
 * This is the model class for table "timeline".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $status
 * @property string $location
 * @property string $link
 * @property integer $idPhoto
 *
 * @property Comments[] $comments
 * @property Likes[] $likes
 * @property Shares[] $shares
 * @property SocialRelations[] $socialRelations
 * @property Photo $photo
 * @property User $user
 */
class Timeline extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%timeline}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'status', 'idPhoto'], 'integer'],
            [['location', 'link'], 'string', 'max' => 255]
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
            'status' => Yii::t('user', 'Status'),
            'location' => Yii::t('user', 'Location'),
            'link' => Yii::t('user', 'Link'),
            'idPhoto' => Yii::t('user', 'Id Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialRelations()
    {
        return $this->hasMany(SocialRelations::className(), ['idTimeline' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(Share::className(), ['id' => 'idShare'])->via('socialRelations');
    }
}
