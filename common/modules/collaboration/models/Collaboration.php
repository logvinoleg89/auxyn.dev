<?php

namespace modules\collaboration\models;

use Yii;
use modules\user\models\User;
use modules\collaboration\models\CollaborationRequest;
use modules\message\models\Message;

/**
 * This is the model class for table "{{%collaboration}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $travelDistance
 * @property string $subject
 * @property string $text
 * @property integer $status
 * @property integer $lookingFor
 * @property integer $iAm
 *
 * @property User $User
 * @property CollaborationRequest[] $collaborationRequests
 * @property Message[] $message
 * @property CollaborationRequests[] $collaborationRequests
 * @property CollaborationUsers[] $collaborationUsers
 */
class Collaboration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collaboration}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'travelDistance', 'status', 'lookingFor', 'iAm'], 'integer'],
            [['subject', 'text'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('collaboration', 'ID'),
            'idUser' => Yii::t('collaboration', 'Id User'),
            'travelDistance' => Yii::t('collaboration', 'Travel Distance'),
            'subject' => Yii::t('collaboration', 'Subject'),
            'text' => Yii::t('collaboration', 'Text'),
            'status' => Yii::t('collaboration', 'Status'),
            'lookingFor' => Yii::t('collaboration', 'Looking For'),
            'iAm' => Yii::t('collaboration', 'I Am'),
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
    public function getCollaborationRequests()
    {
        return $this->hasMany(CollaborationRequest::className(), ['idCollaboration' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['idCollaboration' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollaborationUsers()
    {
         return $this->hasMany(User::className(), ['id' => 'idUser'])->via('collaborationRequests');
    }
}
