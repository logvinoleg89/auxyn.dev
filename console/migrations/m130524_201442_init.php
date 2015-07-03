<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'token' => Schema::TYPE_STRING . '(32) NOT NULL',
            'passwordHash' => Schema::TYPE_STRING . ' NOT NULL',
            'passwordResetToken' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'zipCode' => Schema::TYPE_STRING,
            'country' => Schema::TYPE_STRING,
            'state' => Schema::TYPE_STRING,
            'city' => Schema::TYPE_STRING,
            'lat' => Schema::TYPE_STRING,
            'lon' => Schema::TYPE_STRING,
            'papypalEmail' => Schema::TYPE_STRING,
            'papypalSecurityKey' => Schema::TYPE_STRING,
            'creditCardToken' => Schema::TYPE_STRING,
            'mainPhoto' => Schema::TYPE_INTEGER,
            'bio' => Schema::TYPE_STRING,
            'role' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 10',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
