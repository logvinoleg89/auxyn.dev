<?php

namespace modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;
use modules\photo\models\Photo;

/**
 * This is the model class for table "{{%photoUser}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idPhoto
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Photo $photo
 * @property User $user
 */
class PhotoUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photoUser}}';
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
            [['idUser', 'idPhoto', 'createdAt', 'updatedAt'], 'required'],
            [['idUser', 'idPhoto', 'createdAt', 'updatedAt'], 'integer']
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
            'idPhoto' => Yii::t('user', 'Id Photo'),
            'createdAt' => Yii::t('user', 'Created At'),
            'updatedAt' => Yii::t('user', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'idPhoto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
