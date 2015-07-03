<?php

namespace modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;
use modules\vocabulary\models\Genre;

/**
 * This is the model class for table "{{%userGenre}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idGenre
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Genre $genre
 * @property User $user
 */
class UserGenre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%userGenre}}';
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
            [['idUser', 'idGenre', 'createdAt', 'updatedAt'], 'required'],
            [['idUser', 'idGenre', 'createdAt', 'updatedAt'], 'integer']
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
            'idGenre' => Yii::t('user', 'Id Genre'),
            'createdAt' => Yii::t('user', 'Created At'),
            'updatedAt' => Yii::t('user', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'idGenre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
