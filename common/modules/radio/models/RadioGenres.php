<?php

namespace modules\radio\models;

use Yii;
use modules\vocabulary\models\Genre;
use modules\radio\models\Radio;

/**
 * This is the model class for table "{{%radioGenres}}".
 *
 * @property integer $id
 * @property integer $idGenre
 * @property integer $idRadio
 *
 * @property Genre $idGenre0
 * @property Radio $idRadio0
 */
class RadioGenres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%radioGenres}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idGenre', 'idRadio'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('radio', 'ID'),
            'idGenre' => Yii::t('radio', 'Id Genre'),
            'idRadio' => Yii::t('radio', 'Id Radio'),
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
    public function getRadio()
    {
        return $this->hasOne(Radio::className(), ['id' => 'idRadio']);
    }
}
