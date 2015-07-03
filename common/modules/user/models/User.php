<?php

namespace modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use modules\event\models\Attender;
use modules\user\models\BandMember;
use modules\social\models\Block;
use modules\event\models\Book;
use modules\collaboration\models\Collaboration;
use modules\collaboration\models\CollaborationRequest;
use modules\social\models\Comment;
use modules\track\models\Download;
use modules\event\models\Event;
use modules\user\models\Fan;
use modules\user\models\Favorite;
use modules\user\models\Feedback;
use modules\social\models\Like;
use modules\message\models\Messages;
use modules\user\models\Notification;
use modules\payments\models\Payments;
use modules\user\models\PhotoUser;
use modules\user\models\Rating;
use modules\popular\models\Recommended;
use modules\social\models\Report;
use modules\event\models\Review;
use modules\user\models\Settings;
use modules\social\models\Share;
use modules\user\models\Timeline;
use modules\track\models\Track;
use modules\photo\models\Photo;
use modules\user\models\UserArtist;
use modules\user\models\UserGenre;
use modules\payments\models\UserReceivers;
use modules\vocabulary\models\Artist;
use modules\vocabulary\models\Genre;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $token
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property string $email
 * @property string $zipCode
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $lat
 * @property string $lon
 * @property string $papypalEmail
 * @property string $papypalSecurityKey
 * @property string $creditCardToken
 * @property integer $mainPhoto
 * @property string $bio
 * @property integer $role
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Attender[] $attender
 * @property BandMember[] $bandMembers
 * @property Block[] $bandBlocks
 * @property Block[] $userBlocks
 * @property Book[] $books
 * @property Collaboration[] $collaborations
 * @property CollaborationRequest[] $collaborationRequests
 * @property Comment[] $comments
 * @property Download[] $downloads
 * @property Event[] $events
 * @property Fan[] $fans
 * @property Fan[] $fans0
 * @property Favorite[] $followingFavorites
 * @property Favorite[] $FollowerFavorites
 * @property Feedback[] $feedbacks
 * @property Like[] $likes
 * @property Messages[] $receiverMessages
 * @property Messages[] $senderMessages
 * @property Notification[] $notifications
 * @property Payments[] $payments
 * @property PhotoUser[] $photoUsers
 * @property Rating[] $bandRatings
 * @property Rating[] $userRatings
 * @property Recommended[] $bandRecommendeds
 * @property Recommended[] $recommendeds
 * @property Report[] $reports
 * @property Review[] $reviewer
 * @property Review[] $reviewering
 * @property Settings[] $settings
 * @property Share[] $shares
 * @property Timeline[] $timelines
 * @property Track[] $tracks
 * @property Photo $mainPhoto
 * @property UserArtist[] $userArtists
 * @property UserGenre[] $userGenres
 * @property UserReceivers[] $userReceivers
 * @property Artist[] $artist
 * @property IncomingPyments[] $incomingPyments
 * @property Genres[] $genres
 * @property Photos[] $photos
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_LISTENER = 10;
    const ROLE_MUSICIAN = 11;
    const ROLE_ADMIN = 20;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
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
            [['name', 'token', 'passwordHash', 'email', 'createdAt', 'updatedAt'], 'required'],
            [['mainPhoto', 'role', 'status', 'createdAt', 'updatedAt'], 'integer'],
            [
                [
                    'name',
                    'passwordHash',
                    'passwordResetToken',
                    'email',
                    'zipCode',
                    'country',
                    'state',
                    'city',
                    'lat',
                    'lon',
                    'papypalEmail',
                    'papypalSecurityKey',
                    'creditCardToken',
                    'bio'
                ],
                'string',
                'max' => 255
            ],
            [['token'], 'string', 'max' => 32],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['role', 'default', 'value' => self::ROLE_LISTENER],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            //We do not need ROLE_ADMIN here for security reasons. TODO: Confirm this is true.
            ['role', 'in', 'range' => [self::ROLE_LISTENER, self::ROLE_MUSICIAN]],
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
            'token' => Yii::t('user', 'Token'),
            'passwordHash' => Yii::t('user', 'Password Hash'),
            'passwordResetToken' => Yii::t('user', 'Password Reset Token'),
            'email' => Yii::t('user', 'Email'),
            'zipCode' => Yii::t('user', 'Zip Code'),
            'country' => Yii::t('user', 'Country'),
            'state' => Yii::t('user', 'State'),
            'city' => Yii::t('user', 'City'),
            'lat' => Yii::t('user', 'Lat'),
            'lon' => Yii::t('user', 'Lon'),
            'papypalEmail' => Yii::t('user', 'Papypal Email'),
            'papypalSecurityKey' => Yii::t('user', 'Papypal Security Key'),
            'creditCardToken' => Yii::t('user', 'Credit Card Token'),
            'mainPhoto' => Yii::t('user', 'Main Photo'),
            'bio' => Yii::t('user', 'Bio'),
            'role' => Yii::t('user', 'Role'),
            'status' => Yii::t('user', 'Status'),
            'createdAt' => Yii::t('user', 'Created At'),
            'updatedAt' => Yii::t('user', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->token;
    }

    public function getToken()
    {
        return $this->token;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($token)
    {
        return $this->getToken() === $token;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttenders()
    {
        return $this->hasMany(Attender::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBandMembers()
    {
        return $this->hasMany(BandMember::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBandBlocks()
    {
        return $this->hasMany(Block::className(), ['idUserBand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBlocks()
    {
        return $this->hasMany(Block::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollaborations()
    {
        return $this->hasMany(Collaboration::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollaborationRequests()
    {
        return $this->hasMany(CollaborationRequest::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDownloads()
    {
        return $this->hasMany(Download::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBandFans()
    {
        return $this->hasMany(Fan::className(), ['idUserBand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFans()
    {
        return $this->hasMany(Fan::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFollowingFavorites()
    {
        return $this->hasMany(Favorite::className(), ['idUserFollowing' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFollowerFavorites()
    {
        return $this->hasMany(Favorite::className(), ['idUserFollower' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverMessages()
    {
        return $this->hasMany(Messages::className(), ['idUserReceiver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenderMessages()
    {
        return $this->hasMany(Messages::className(), ['idUserSender' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutgoingPayments()
    {
        return $this->hasMany(Payments::className(), ['idUserSender' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoUsers()
    {
        return $this->hasMany(PhotoUser::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBandRatings()
    {
        return $this->hasMany(Rating::className(), ['idUserBand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRatings()
    {
        return $this->hasMany(Rating::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBandRecommendeds()
    {
        return $this->hasMany(Recommended::className(), ['idUserBand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendeds()
    {
        return $this->hasMany(Recommended::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewer()
    {
        return $this->hasMany(Review::className(), ['idUserReviewer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewings()
    {
        return $this->hasMany(Review::className(), ['idUserReviewing' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(Share::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimelines()
    {
        return $this->hasMany(Timeline::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTracks()
    {
        return $this->hasMany(Track::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'mainPhoto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserArtists()
    {
        return $this->hasMany(UserArtist::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGenres()
    {
        return $this->hasMany(UserGenre::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserReceivers()
    {
        return $this->hasMany(UserReceivers::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenderCollaborations()
    {
        return $this->hasMany(Collaboration::className(), ['id' => 'idCollaboration'])->via('collaborationRequests');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtists()
    {
        return $this->hasMany(Artist::className(), ['id' => 'idArtist'])->via('userArtists');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomingPyments()
    {
        return $this->hasMany(Payments::className(), ['id' => 'idPyments'])->via('userReceivers');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id' => 'idGenre'])->via('userGenres');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['id' => 'idPhoto'])->via('photoUsers');
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
