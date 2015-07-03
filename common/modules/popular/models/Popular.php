<?php

namespace modules\popular\models;

use Yii;
use modules\track\models\Track;

/**
 * This is the model class for table "{{%popular}}".
 *
 * @property integer $id
 * @property integer $idTrack
 * @property string $amount
 *
 * @property Track $idTrack0
 */
class Popular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%popular}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTrack'], 'required'],
            [['idTrack'], 'integer'],
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
}
