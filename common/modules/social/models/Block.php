<?php

namespace modules\social\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;
use modules\track\models\Track;

/**
 * This is the model class for table "{{%block}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idUserBand
 * @property integer $idTrack
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Track $idTrack0
 * @property User $idUserBand0
 * @property User $idUser0
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block}}';
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
            [['idUser', 'idUserBand', 'createdAt', 'updatedAt'], 'required'],
            [['idUser', 'idUserBand', 'idTrack', 'createdAt', 'updatedAt'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'idUser' => Yii::t('social', 'Id User'),
            'idUserBand' => Yii::t('social', 'Id User Band'),
            'idTrack' => Yii::t('social', 'Id Track'),
            'createdAt' => Yii::t('social', 'Created At'),
            'updatedAt' => Yii::t('social', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::className(), ['id' => 'idTrack']);
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
