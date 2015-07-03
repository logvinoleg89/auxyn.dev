<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_125610_add_track_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%track}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'idAudio' => Schema::TYPE_INTEGER,
            'idLyrics' => Schema::TYPE_INTEGER,
            'idVideo' => Schema::TYPE_INTEGER,
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('trackUserKey', '{{%track}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
        
        
        $this->createTable('{{%audio}}', [
            'id' => Schema::TYPE_PK,
            'file' => Schema::TYPE_STRING . ' NOT NULL',
            'barChart' => Schema::TYPE_INTEGER,
            'duration' => Schema::TYPE_DECIMAL . '(15,2) DEFAULT 0',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->createTable('{{%lyrics}}', [
            'id' => Schema::TYPE_PK,
            'text' => Schema::TYPE_STRING . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->createTable('{{%video}}', [
            'id' => Schema::TYPE_PK,
            'url' => Schema::TYPE_STRING . ' NOT NULL',
            'title' => Schema::TYPE_STRING,
            'author' => Schema::TYPE_STRING,
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('trackAudioKey', '{{%track}}', 'idAudio', '{{%audio}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('trackLyricsKey', '{{%track}}', 'idLyrics', '{{%lyrics}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('trackVideoKey', '{{%track}}', 'idVideo', '{{%video}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%track}}');
        $this->dropTable('{{%audio}}');
        $this->dropTable('{{%lyrics}}');
        $this->dropTable('{{%video}}');
    }
}
