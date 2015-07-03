<?php

namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use modules\user\models\User;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $idUser
 * @property string $text
 * @property integer $status
 * @property integer $read
 *
 * @property User $idUser0
 */
class Notification extends ActiveRecord

{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'text'], 'required'],
            [['idUser', 'status', 'read'], 'integer'],
            [['text'], 'string', 'max' => 255]
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
            'text' => Yii::t('user', 'Text'),
            'status' => Yii::t('user', 'Status'),
            'read' => Yii::t('user', 'Read'),
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
