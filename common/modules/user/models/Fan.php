<?php

namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use modules\user\models\User;

/**
 * This is the model class for table "fan".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idUserBand
 *
 * @property User $idUserBand0
 * @property User $idUser0
 */
class Fan extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idUserBand'], 'integer']
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
            'idUserBand' => Yii::t('user', 'Id User Band'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBand()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserBand']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
