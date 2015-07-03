<?php

namespace modules\event\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\vocabulary\models\Genre;
use modules\event\models\Event;

/**
 * This is the model class for table "{{%eventGenre}}".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property integer $idGenre
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Genre $idGenre0
 * @property Event $idEvent0
 */
class EventGenre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eventGenre}}';
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
            [['idEvent', 'createdAt', 'updatedAt'], 'required'],
            [['idEvent', 'idGenre', 'createdAt', 'updatedAt'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('event', 'ID'),
            'idEvent' => Yii::t('event', 'Id Event'),
            'idGenre' => Yii::t('event', 'Id Genre'),
            'createdAt' => Yii::t('event', 'Created At'),
            'updatedAt' => Yii::t('event', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'idGenre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }
}
