<?php

namespace modules\event\models;

use Yii;
use modules\user\models\User;
use modules\event\models\Event;

/**
 * This is the model class for table "{{%attender}}".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property integer $idUser
 *
 * @property User $user
 * @property Event $event
 */
class Attender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attender}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEvent', 'idUser'], 'integer']
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
            'idUser' => Yii::t('event', 'Id User'),
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
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }
}
