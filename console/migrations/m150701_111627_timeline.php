<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_111627_timeline extends Migration
{
   public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%timeline}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER,
            'textLinks' => Schema::TYPE_STRING,
            'images' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
        ], $tableOptions);


        $this->addForeignKey('timelineUserKey', '{{%timeline}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%timeline}}');
    }
}
