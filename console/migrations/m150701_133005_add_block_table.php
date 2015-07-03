<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_133005_add_block_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idUserBand' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idTrack' => Schema::TYPE_INTEGER,
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('blockUserKey', '{{%block}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('blockUserBandKey', '{{%block}}', 'idUserBand', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('blockTrackKey', '{{%block}}', 'idTrack', '{{%track}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%block}}');
    }
}
