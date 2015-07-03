<?php

namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use modules\user\models\User;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idUserBand
 * @property string $ratingAmount
 *
 * @property User $userBand
 * @property User $user
 */
class Rating extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rating}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idUserBand'], 'integer'],
            [['ratingAmount'], 'number']
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
            'ratingAmount' => Yii::t('user', 'Rating Amount'),
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
