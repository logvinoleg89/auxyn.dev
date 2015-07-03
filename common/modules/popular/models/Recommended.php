<?php

namespace modules\popular\models;

use Yii;
use modules\user\models\User;
use modules\track\models\Track;

/**
 * This is the model class for table "{{%recommended}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idUserBand
 * @property integer $idTrack
 * @property string $amount
 *
 * @property Track $idtrack
 * @property User $iduserband
 * @property User $iduser
 */
class Recommended extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recommended}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idUserBand'], 'required'],
            [['idUser', 'idUserBand', 'idTrack'], 'integer'],
            [['amount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('popular', 'ID'),
            'idUser' => Yii::t('popular', 'Id User'),
            'idUserBand' => Yii::t('popular', 'Id User Band'),
            'idTrack' => Yii::t('popular', 'Id Track'),
            'amount' => Yii::t('popular', 'Amount'),
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
