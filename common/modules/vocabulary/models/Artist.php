<?php

namespace modules\vocabulary\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;
use modules\user\models\UserArtist;

/**
 * This is the model class for table "{{%artist}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property UserArtist[] $userArtists
 * @property Users[] $users
 */
class Artist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%artist}}';
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
            [['name', 'createdAt', 'updatedAt'], 'required'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('vocabulary', 'ID'),
            'name' => Yii::t('vocabulary', 'Name'),
            'status' => Yii::t('vocabulary', 'Status'),
            'createdAt' => Yii::t('vocabulary', 'Created At'),
            'updatedAt' => Yii::t('vocabulary', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserArtists()
    {
        return $this->hasMany(UserArtist::className(), ['idArtist' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'idUser'])->via('userArtists');
    }
}
