<?php

namespace modules\event\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use modules\user\models\User;
use modules\event\models\Attender;
use modules\event\models\Book;
use modules\event\models\EventGenre;
use modules\event\models\Review;
use modules\message\models\Message;
use modules\vocabulary\models\Genre;
use modules\social\models\SocialRelations;
use modules\social\models\Comment;
use modules\social\models\Like;
use modules\social\models\Share;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property integer $id
 * @property integer $idUser
 * @property string $name
 * @property integer $startTime
 * @property integer $endTime
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $address
 * @property string $description
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property integer $isPublic
 * @property string $type
 *
 * @property Attender[] $attender
 * @property Book[] $books
 * @property User $user
 * @property EventGenre[] $eventGenres
 * @property Message[] $message
 * @property Review[] $reviews
 * @property SocialRelations[] $socialRelations
 * @property Genres[] $genres
 * @property Comments[] $comments
 * @property Likes[] $likes
 * @property Shares[] $shares
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event}}';
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
            [['idUser', 'startTime', 'endTime', 'createdAt', 'updatedAt', 'isPublic'], 'integer'],
            [['name', 'country', 'state', 'city', 'address', 'description', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('event', 'ID'),
            'idUser' => Yii::t('event', 'Id User'),
            'name' => Yii::t('event', 'Name'),
            'startTime' => Yii::t('event', 'Start Time'),
            'endTime' => Yii::t('event', 'End Time'),
            'country' => Yii::t('event', 'Country'),
            'state' => Yii::t('event', 'State'),
            'city' => Yii::t('event', 'City'),
            'address' => Yii::t('event', 'Address'),
            'description' => Yii::t('event', 'Description'),
            'createdAt' => Yii::t('event', 'Created At'),
            'updatedAt' => Yii::t('event', 'Updated At'),
            'isPublic' => Yii::t('event', 'Is Public'),
            'type' => Yii::t('event', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttenders()
    {
        return $this->hasMany(Attender::className(), ['idEvent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['idEvent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventGenres()
    {
        return $this->hasMany(EventGenre::className(), ['idEvent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['idEvent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::className(), ['idEvent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialRelations()
    {
        return $this->hasMany(SocialRelations::className(), ['idEvent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id' => 'idGenre'])->via('eventGenres');
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
