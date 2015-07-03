<?php

namespace modules\radio\models;

use Yii;
use modules\radio\models\RadioGenres;
use modules\social\models\SocialRelations;
use modules\vocabulary\models\Genre;
use modules\social\models\Comment;
use modules\social\models\Like;
use modules\social\models\Share;

/**
 * This is the model class for table "{{%radio}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property RadioGenres[] $radioGenres
 * @property SocialRelations[] $socialRelations
 * @property Comments[] $Comments
 * @property Likes[] $likes
 * @property Genres[] $Genres
 * @property Shares[] $Shares
 */
class Radio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%radio}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('radio', 'ID'),
            'name' => Yii::t('radio', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadioGenres()
    {
        return $this->hasMany(RadioGenres::className(), ['idRadio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialRelations()
    {
        return $this->hasMany(SocialRelations::className(), ['idRadio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id' => 'idGenre'])->via('radioGenres');
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['id' => 'idComment'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['id' => 'idLike'])->via('socialRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(Share::className(), ['id' => 'idShare'])->via('socialRelations');
    }
}
