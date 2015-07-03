<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_112727_collaboration extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%collaboration}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER,
            'type' => Schema::TYPE_STRING,
            'status' => 'ENUM("pending", "full" ,"completed") NOT NULL DEFAULT "pending"',
            'travelDistance' => Schema::TYPE_INTEGER,
            'subject' => Schema::TYPE_STRING,
            'text' => Schema::TYPE_STRING,
        ], $tableOptions);


        $this->addForeignKey('collaborationUserKey', '{{%collaboration}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%collaboration}}');
    }
}
