<?php

namespace modules\payment\models;

use Yii;
use modules\payment\models\Payment;
use modules\payment\models\User;
/**
 * This is the model class for table "{{%userReceivers}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idPyments
 * @property string $amount
 *
 * @property Payment $pyments
 * @property User $user
 */
class UserReceivers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%userReceivers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idPyments'], 'integer'],
            [['amount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('payment', 'ID'),
            'idUser' => Yii::t('payment', 'Id User'),
            'idPyments' => Yii::t('payment', 'Id Pyments'),
            'amount' => Yii::t('payment', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPyment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'idPyments']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
