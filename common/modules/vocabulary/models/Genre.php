<?php

namespace modules\vocabulary\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\event\models\Event;
use modules\event\models\EventGenre;
use modules\radio\models\Radio;
use modules\radio\models\RadioGenres;
use modules\user\models\User;
use modules\user\models\UserGenre;

/**
 * This is the model class for table "{{%genre}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property EventGenre[] $eventGenres
 * @property RadioGenres[] $radioGenres
 * @property UserGenre[] $userGenres
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%genre}}';
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
            [['name', 'createdAt', 'updatedAt'], 'required'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('vocabulary', 'ID'),
            'name' => Yii::t('vocabulary', 'Name'),
            'status' => Yii::t('vocabulary', 'Status'),
            'createdAt' => Yii::t('vocabulary', 'Created At'),
            'updatedAt' => Yii::t('vocabulary', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventGenres()
    {
        return $this->hasMany(EventGenre::className(), ['idGenre' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadioGenres()
    {
        return $this->hasMany(RadioGenres::className(), ['idGenre' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGenres()
    {
        return $this->hasMany(UserGenre::className(), ['idGenre' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'idUser'])->via('userGenres');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadios()
    {
        return $this->hasMany(Radio::className(), ['id' => 'idRadio'])->via('radioGenres');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['id' => 'idEvent'])->via('eventGenres');
    }
}
