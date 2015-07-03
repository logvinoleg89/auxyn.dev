<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_095428_add_artists_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%artist}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->createTable('{{%userArtist}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idArtist' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 10',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('userArtistUserKey', '{{%userArtist}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('userArtistArtistKey', '{{%userArtist}}', 'idArtist', '{{%artist}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%userArtist}}');
        $this->dropTable('{{%artist}}');
    }
}
