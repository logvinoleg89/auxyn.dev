<?php

namespace modules\social\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\radio\models\Radio;
use modules\track\models\Audio;
use modules\social\models\Comment;
use modules\event\models\Event;
use modules\social\models\Like;
use modules\track\models\Lyrics;
use modules\photo\models\Photo;
use modules\social\models\Share;
use modules\user\models\Timeline;
use modules\track\models\Video;

/**
 * This is the model class for table "{{%socialRelations}}".
 *
 * @property integer $id
 * @property integer $idComment
 * @property integer $idLike
 * @property integer $idShare
 * @property integer $idAudio
 * @property integer $idLyrics
 * @property integer $idVideo
 * @property integer $idTimeline
 * @property integer $idPhoto
 * @property integer $idEvent
 * @property integer $idRadio
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Radio $idRadio0
 * @property Audio $idAudio0
 * @property Comment $idComment0
 * @property Event $idEvent0
 * @property Like $idLike0
 * @property Lyrics $idLyrics0
 * @property Photo $idPhoto0
 * @property Share $idShare0
 * @property Timeline $idTimeline0
 * @property Video $idVideo0
 */
class SocialRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%socialRelations}}';
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
            [['idComment', 'idLike', 'idShare', 'idAudio', 'idLyrics', 'idVideo', 'idTimeline', 'idPhoto', 'idEvent', 'idRadio', 'createdAt', 'updatedAt'], 'integer'],
            [['createdAt', 'updatedAt'], 'required'],
            [['idComment', 'idLike', 'idShare'], 'required'],
            [['idAudio'], 'required', 'when' => function($model) {
                return (
                    empty($model->idLyrics) &&
                    empty($model->idVideo) &&
                    empty($model->idTimeline) &&
                    empty($model->idPhoto) &&
                    empty($model->idEvent) &&
                    empty($model->idRadio)
                );
            }],
            [['idLyrics'], 'required', 'when' => function($model) {
                return (
                    empty($model->idAudio) &&
                    empty($model->idVideo) &&
                    empty($model->idTimeline) &&
                    empty($model->idPhoto) &&
                    empty($model->idEvent) &&
                    empty($model->idRadio)
                );
            }],
            [['idVideo'], 'required', 'when' => function($model) {
                return (
                    empty($model->idAudio) &&
                    empty($model->idLyrics) &&
                    empty($model->idTimeline) &&
                    empty($model->idPhoto) &&
                    empty($model->idEvent) &&
                    empty($model->idRadio)
                );
            }],
            [['idTimeline'], 'required', 'when' => function($model) {
                return (
                    empty($model->idAudio) &&
                    empty($model->idLyrics) &&
                    empty($model->idVideo) &&
                    empty($model->idPhoto) &&
                    empty($model->idEvent) &&
                    empty($model->idRadio)
                );
            }],
            [['idPhoto'], 'required', 'when' => function($model) {
                return (
                    empty($model->idAudio) &&
                    empty($model->idLyrics) &&
                    empty($model->idVideo) &&
                    empty($model->idTimeline) &&
                    empty($model->idEvent) &&
                    empty($model->idRadio)
                );
            }],
            [['idEvent'], 'required', 'when' => function($model) {
                return (
                    empty($model->idAudio) &&
                    empty($model->idLyrics) &&
                    empty($model->idVideo) &&
                    empty($model->idTimeline) &&
                    empty($model->idPhoto) &&
                    empty($model->idEvent) &&
                    empty($model->idRadio)
                );
            }],
            [['idRadio'], 'required', 'when' => function($model) {
                return (
                    empty($model->idAudio) &&
                    empty($model->idLyrics) &&
                    empty($model->idVideo) &&
                    empty($model->idTimeline) &&
                    empty($model->idPhoto) &&
                    empty($model->idEvent)
                );
            }],
            [['idComment'], 'required', 'when' => function($model) {
                return ( empty($model->idLike) && empty($model->idShare) );
            }],
            [['idLike'], 'required', 'when' => function($model) {
                return ( empty($model->idComment) && empty($model->idShare) );
            }],
            [['idShare'], 'required', 'when' => function($model) {
                return ( empty($model->idComment) && empty($model->idLike) );
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'idComment' => Yii::t('social', 'Id Comment'),
            'idLike' => Yii::t('social', 'Id Like'),
            'idShare' => Yii::t('social', 'Id Share'),
            'idAudio' => Yii::t('social', 'Id Audio'),
            'idLyrics' => Yii::t('social', 'Id Lyrics'),
            'idVideo' => Yii::t('social', 'Id Video'),
            'idTimeline' => Yii::t('social', 'Id Timeline'),
            'idPhoto' => Yii::t('social', 'Id Photo'),
            'idEvent' => Yii::t('social', 'Id Event'),
            'idRadio' => Yii::t('social', 'Id Radio'),
            'createdAt' => Yii::t('social', 'Created At'),
            'updatedAt' => Yii::t('social', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadio()
    {
        return $this->hasOne(Radio::className(), ['id' => 'idRadio']);
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
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'idComment']);
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
    public function getLike()
    {
        return $this->hasOne(Like::className(), ['id' => 'idLike']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLyrics()
    {
        return $this->hasOne(Lyrics::className(), ['id' => 'idLyrics']);
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
    public function getShare()
    {
        return $this->hasOne(Share::className(), ['id' => 'idShare']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeline()
    {
        return $this->hasOne(Timeline::className(), ['id' => 'idTimeline']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' => 'idVideo']);
    }
}
