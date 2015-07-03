<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_090845_event extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%event}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER,
            'piblic' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'name' => Schema::TYPE_STRING,
            'eventType' => Schema::TYPE_STRING,
            'startTime' => Schema::TYPE_INTEGER,
            'endTime' => Schema::TYPE_INTEGER,
            'country' => Schema::TYPE_STRING,
            'state' => Schema::TYPE_STRING,
            'city' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_STRING,
            'genres' => Schema::TYPE_STRING,
            'createdAt' => Schema::TYPE_INTEGER,
            'updatedAt' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('eventUserKey', '{{%event}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%event}}');
    }
}
