<?php

namespace modules\track\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\social\models\Block;
use modules\track\models\Download;
use modules\popular\models\Popular;
use modules\popular\models\Recommended;
use modules\track\models\Video;
use modules\track\models\Audio;
use modules\track\models\Lyrics;
use modules\user\models\User;

/**
 * This is the model class for table "track".
 *
 * @property integer $id
 * @property integer $idUser
 * @property string $name
 * @property integer $idAudio
 * @property integer $idLyrics
 * @property integer $idVideo
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Block[] $blocks
 * @property Download[] $downloads
 * @property Popular[] $populars
 * @property Recommended[] $recommendeds
 * @property Video $video
 * @property Audio $audio
 * @property Lyrics $lyrics
 * @property User $user
 */
class Track extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%track}}';
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
            [['idUser', 'name', 'createdAt', 'updatedAt'], 'required'],
            [['idUser', 'idAudio', 'idLyrics', 'idVideo', 'createdAt', 'updatedAt'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('track', 'ID'),
            'idUser' => Yii::t('track', 'Id User'),
            'name' => Yii::t('track', 'Name'),
            'idAudio' => Yii::t('track', 'Id Audio'),
            'idLyrics' => Yii::t('track', 'Id Lyrics'),
            'idVideo' => Yii::t('track', 'Id Video'),
            'createdAt' => Yii::t('track', 'Created At'),
            'updatedAt' => Yii::t('track', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlocks()
    {
        return $this->hasMany(Block::className(), ['idTrack' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDownloads()
    {
        return $this->hasMany(Download::className(), ['idTrack' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPopulars()
    {
        return $this->hasMany(Popular::className(), ['idTrack' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendeds()
    {
        return $this->hasMany(Recommended::className(), ['idTrack' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' => 'idVideo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudio()
    {
        return $this->hasOne(Audio::className(), ['id' => 'idAudio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLyric()
    {
        return $this->hasOne(Lyrics::className(), ['id' => 'idLyrics']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
