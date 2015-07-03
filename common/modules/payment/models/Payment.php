<?php

namespace modules\payment\models;

use Yii;
use modules\user\models\User;
use modules\user\models\UserReceivers;

/**
 * This is the model class for table "{{%payment}}".
 *
 * @property integer $id
 * @property string $amount
 * @property integer $idUserSender
 * @property string $transactionId
 * @property integer $status
 * @property string $description
 *
 * @property User $idUserSender
 * @property UserReceivers[] $userReceivers
 * @property ReceiverUsers[] $receiverUsers
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['idUserSender', 'status'], 'integer'],
            [['transactionId', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('payment', 'ID'),
            'amount' => Yii::t('payment', 'Amount'),
            'idUserSender' => Yii::t('payment', 'Id User Sender'),
            'transactionId' => Yii::t('payment', 'Transaction ID'),
            'status' => Yii::t('payment', 'Status'),
            'description' => Yii::t('payment', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSender()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserSender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserReceivers()
    {
        return $this->hasMany(UserReceivers::className(), ['idPyments' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'idUser'])->via('userReceivers');
    }
}
