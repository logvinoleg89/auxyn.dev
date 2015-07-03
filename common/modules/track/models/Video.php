<?php

namespace modules\track\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\track\models\Track;
use modules\social\models\SocialRelations;
use modules\social\models\Comment;
use modules\social\models\Share;
use modules\social\models\Like;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $author
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property SocialRelations[] $socialRelations
 * @property Track[] $tracks
 * @property Comments[] $Comments
 * @property Likes[] $likes
 * @property Share[] $share
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
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
            [['url', 'createdAt', 'updatedAt'], 'required'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['url', 'title', 'author'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('track', 'ID'),
            'url' => Yii::t('track', 'Url'),
            'title' => Yii::t('track', 'Title'),
            'author' => Yii::t('track', 'Author'),
            'createdAt' => Yii::t('track', 'Created At'),
            'updatedAt' => Yii::t('track', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialRelations()
    {
        return $this->hasMany(SocialRelations::className(), ['idVideo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::className(), ['idVideo' => 'id']);
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
