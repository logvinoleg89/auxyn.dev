<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_094607_attenders extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attenders}}', [
            'id' => Schema::TYPE_PK,
            'idEvent' => Schema::TYPE_INTEGER,
            'idUser' => Schema::TYPE_INTEGER,
        ], $tableOptions);


        $this->addForeignKey('attendersEventKey', '{{%attenders}}', 'idEvent', '{{%event}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('attendersUserKey', '{{%attenders}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%attenders}}');
    }
}
