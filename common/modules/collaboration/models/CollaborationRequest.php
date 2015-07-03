<?php

namespace modules\collaboration\models;

use Yii;
use modules\user\models\User;
use modules\collaboration\models\Collaboration;

/**
 * This is the model class for table "{{%collaborationRequest}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idCollaboration
 * @property integer $status
 *
 * @property Collaboration $collaboration
 * @property User $user
 */
class CollaborationRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collaborationRequest}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idCollaboration'], 'required'],
            [['idUser', 'idCollaboration', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('collaboration', 'ID'),
            'idUser' => Yii::t('collaboration', 'Id User'),
            'idCollaboration' => Yii::t('collaboration', 'Id Collaboration'),
            'status' => Yii::t('collaboration', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollaboration()
    {
        return $this->hasOne(Collaboration::className(), ['id' => 'idCollaboration']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
