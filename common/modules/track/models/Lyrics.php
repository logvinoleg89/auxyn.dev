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
 * This is the model class for table "{{%lyrics}}".
 *
 * @property integer $id
 * @property string $text
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property SocialRelations[] $socialRelations
 * @property Track[] $tracks
 * @property Comments[] $Comments
 * @property Likes[] $likes
 * @property Share[] $share
 */
class Lyrics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lyrics}}';
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
            [['createdAt', 'updatedAt'], 'integer'],
            [['text'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('track', 'ID'),
            'text' => Yii::t('track', 'Text'),
            'createdAt' => Yii::t('track', 'Created At'),
            'updatedAt' => Yii::t('track', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialRelations()
    {
        return $this->hasMany(SocialRelations::className(), ['idLyrics' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::className(), ['idLyrics' => 'id']);
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
