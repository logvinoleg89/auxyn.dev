<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_133936_add_download_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%download}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idTrack' => Schema::TYPE_INTEGER . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('downloadUserKey', '{{%download}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('downloadTrackKey', '{{%download}}', 'idTrack', '{{%track}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%download}}');
    }
}
