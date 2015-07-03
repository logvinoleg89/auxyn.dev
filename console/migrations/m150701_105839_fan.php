<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_105839_fan extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%fan}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER,
            'idUserBand' => Schema::TYPE_INTEGER,
        ], $tableOptions);


        $this->addForeignKey('fanUserKey', '{{%fan}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fanUserBandKey', '{{%fan}}', 'idUserBand', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%fan}}');
    }
}
