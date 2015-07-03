<?php

namespace modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $notificationPayment
 * @property integer $notificationComunity
 * @property integer $notificationCollaboration
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property User $user
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
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
            [['idUser', 'notificationPayment', 'notificationComunity', 'notificationCollaboration', 'createdAt', 'updatedAt'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'idUser' => Yii::t('user', 'Id User'),
            'notificationPayment' => Yii::t('user', 'Notification Payment'),
            'notificationComunity' => Yii::t('user', 'Notification Comunity'),
            'notificationCollaboration' => Yii::t('user', 'Notification Collaboration'),
            'createdAt' => Yii::t('user', 'Created At'),
            'updatedAt' => Yii::t('user', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
