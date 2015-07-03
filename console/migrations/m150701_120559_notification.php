<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_120559_notification extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notification}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'text' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' DEFAULT 1',
            'read' => Schema::TYPE_BOOLEAN . ' DEFAULT 1',
        ], $tableOptions);

        $this->addForeignKey('notificationUserKey', '{{%notification}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%notification}}');
    }

}
