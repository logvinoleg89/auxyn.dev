<?php

namespace modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;

/**
 * This is the model class for table "{{%bandMember}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $role
 * @property integer $idUser
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property User $user
 */
class BandMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bandMember}}';
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
            [['name', 'role', 'idUser', 'createdAt', 'updatedAt'], 'required'],
            [['idUser', 'createdAt', 'updatedAt'], 'integer'],
            [['name', 'role'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'name' => Yii::t('user', 'Name'),
            'role' => Yii::t('user', 'Role'),
            'idUser' => Yii::t('user', 'Id User'),
            'createdAt' => Yii::t('user', 'Created At'),
            'updatedAt' => Yii::t('user', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
