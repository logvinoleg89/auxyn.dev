<?php

namespace modules\track\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\track\models\Track;
use modules\user\models\User;

/**
 * This is the model class for table "download".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idTrack
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Track $track
 * @property User $user
 */
class Download extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%download}}';
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
            [['idUser', 'idTrack', 'createdAt', 'updatedAt'], 'required'],
            [['idUser', 'idTrack', 'createdAt', 'updatedAt'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('track', 'ID'),
            'idUser' => Yii::t('track', 'Id User'),
            'idTrack' => Yii::t('track', 'Id Track'),
            'createdAt' => Yii::t('track', 'Created At'),
            'updatedAt' => Yii::t('track', 'Updated At'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
