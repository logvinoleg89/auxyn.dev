<?php

namespace modules\social\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;
use modules\social\models\SocialRelations;
use modules\track\models\Video;
use modules\track\models\Lyrics;
use modules\track\models\Audio;
use modules\photo\models\Photo;
use modules\radio\models\Radio;
use modules\user\models\Timeline;

/**
 * This is the model class for table "{{%like}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property User $idUser
 * @property SocialRelations[] $socialRelations
 * @property Video[] $video
 * @property Lyrics[] $lyrics
 * @property Audio[] $audio
 * @property Photo[] $photo
 * @property Radio[] $radio
 * @property Timeline[] $timeline
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%like}}';
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
            [['idUser', 'createdAt', 'updatedAt'], 'required'],
            [['idUser', 'createdAt', 'updatedAt'], 'integer']
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
            'createdAt' => Yii::t('social', 'Created At'),
            'updatedAt' => Yii::t('social', 'Updated At'),
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
    public function getSocialRelations()
    {
        return $this->hasMany(SocialRelations::className(), ['idLike' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' => 'idVideo'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLyric()
    {
        return $this->hasOne(Lyrics::className(), ['id' => 'idLyrics'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudio()
    {
        return $this->hasOne(Audio::className(), ['id' => 'idAudio'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'idVideo'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadio()
    {
        return $this->hasOne(Radio::className(), ['id' => 'idRadio'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeline()
    {
        return $this->hasOne(Timeline::className(), ['id' => 'idTimeline'])->via('socialRelations');
    }
}
