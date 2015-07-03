<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_134406_add_social_relation_tables extends Migration
{
public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%comment}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'text' => Schema::TYPE_STRING . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('commentUserKey', '{{%comment}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%like}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('likeUserKey', '{{%like}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%share}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('shareUserKey', '{{%share}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
        
        
        $this->createTable('{{%socialRelations}}', [
            'id' => Schema::TYPE_PK,
            'idComment' => Schema::TYPE_INTEGER,
            'idLike' => Schema::TYPE_INTEGER,
            'idShare' => Schema::TYPE_INTEGER,
            'idAudio' => Schema::TYPE_INTEGER,
            'idLyrics' => Schema::TYPE_INTEGER,
            'idVideo' => Schema::TYPE_INTEGER,
            'idTimeline' => Schema::TYPE_INTEGER,
            'idPhoto' => Schema::TYPE_INTEGER,
            'idEvent' => Schema::TYPE_INTEGER,
            'idRadio' => Schema::TYPE_INTEGER,
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('socialRelationsCommentKey', '{{%socialRelations}}', 'idComment', '{{%comment}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsLikeKey', '{{%socialRelations}}', 'idLike', '{{%like}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsShareKey', '{{%socialRelations}}', 'idShare', '{{%share}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsAudioKey', '{{%socialRelations}}', 'idAudio', '{{%audio}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsLyricsKey', '{{%socialRelations}}', 'idLyrics', '{{%lyrics}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsVideoKey', '{{%socialRelations}}', 'idVideo', '{{%video}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsTimelineKey', '{{%socialRelations}}', 'idTimeline', '{{%timeline}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsPhotoKey', '{{%socialRelations}}', 'idPhoto', '{{%photo}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsEventKey', '{{%socialRelations}}', 'idEvent', '{{%event}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('socialRelationsRadioKey', '{{%socialRelations}}', 'idRadio', '{{%radio}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%socialRelations}}');
        $this->dropTable('{{%comment}}');
        $this->dropTable('{{%like}}');
        $this->dropTable('{{%share}}');
    }
}
