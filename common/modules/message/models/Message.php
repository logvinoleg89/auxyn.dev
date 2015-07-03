<?php

namespace modules\message\models;

use Yii;
use modules\user\models\User;
use modules\collaboration\models\Collaboration;
use modules\event\models\Event;
use modules\photo\models\Photo;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property integer $idUserSender
 * @property integer $idUserReceiver
 * @property integer $idCollaboration
 * @property integer $idEvent
 * @property integer $idPhoto
 * @property string $link
 * @property integer $status
 * @property string $subject
 * @property string $text
 * @property string $location
 *
 * @property Photo $photo
 * @property Collaboration $collaboration
 * @property Event $event
 * @property User $userReceiver
 * @property User $userSender
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUserSender', 'idUserReceiver', 'idCollaboration', 'idEvent', 'idPhoto', 'status'], 'integer'],
            [['link', 'subject', 'text', 'location'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('message', 'ID'),
            'idUserSender' => Yii::t('message', 'Id User Sender'),
            'idUserReceiver' => Yii::t('message', 'Id User Receiver'),
            'idCollaboration' => Yii::t('message', 'Id Collaboration'),
            'idEvent' => Yii::t('message', 'Id Event'),
            'idPhoto' => Yii::t('message', 'Id Photo'),
            'link' => Yii::t('message', 'Link'),
            'status' => Yii::t('message', 'Status'),
            'subject' => Yii::t('message', 'Subject'),
            'text' => Yii::t('message', 'Text'),
            'location' => Yii::t('message', 'Location'),
        ];
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
    public function getCollaboration()
    {
        return $this->hasOne(Collaboration::className(), ['id' => 'idCollaboration']);
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
    public function getUserReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserReceiver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSender()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserSender']);
    }
}
