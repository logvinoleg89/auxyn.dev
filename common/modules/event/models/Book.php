<?php

namespace modules\event\models;

use Yii;
use modules\user\models\User;
use modules\event\models\Event;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property integer $idUser
 * @property string $compensation
 * @property integer $status
 *
 * @property Event $idEvent0
 * @property User $idUser0
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEvent', 'idUser', 'status'], 'integer'],
            [['compensation'], 'number']
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
            'compensation' => Yii::t('event', 'Compensation'),
            'status' => Yii::t('event', 'Status'),
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
