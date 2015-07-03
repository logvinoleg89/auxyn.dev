<?php

namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use modules\user\models\User;

/**
 * This is the model class for table "favorite".
 *
 * @property integer $id
 * @property integer $idUserFollower
 * @property integer $idUserFollowing
 *
 * @property User $userFollowing
 * @property User $userFollower
 */
class Favorite extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%favorite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUserFollower', 'idUserFollowing'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'idUserFollower' => Yii::t('user', 'Id User Follower'),
            'idUserFollowing' => Yii::t('user', 'Id User Following'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFollowing()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserFollowing']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFollower()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserFollower']);
    }
}
