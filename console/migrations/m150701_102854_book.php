<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_102854_book extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => Schema::TYPE_PK,
            'idEvent' => Schema::TYPE_INTEGER,
            'idUser' => Schema::TYPE_INTEGER,
            'compensation' => Schema::TYPE_INTEGER,
            'status' => 'ENUM("pending", "confirmed" ,"rejected") NOT NULL DEFAULT "pending"',
        ], $tableOptions);


        $this->addForeignKey('bookEventKey', '{{%book}}', 'idEvent', '{{%event}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('bookUserKey', '{{%book}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}
