<?php

namespace modules\payments\models;

use Yii;
use modules\payments\models\Payments;
use modules\payments\models\User;
/**
 * This is the model class for table "{{%userReceivers}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idPyments
 * @property string $amount
 *
 * @property Payments $pyments
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
            'id' => Yii::t('user', 'ID'),
            'idUser' => Yii::t('user', 'Id User'),
            'idPyments' => Yii::t('user', 'Id Pyments'),
            'amount' => Yii::t('user', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPyment()
    {
        return $this->hasOne(Payments::className(), ['id' => 'idPyments']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
