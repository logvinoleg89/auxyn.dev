<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_113306_add_settings_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'notificationPayment' => Schema::TYPE_BOOLEAN . ' DEFAULT 1',
            'notificationComunity' => Schema::TYPE_BOOLEAN . ' DEFAULT 1',
            'notificationCollaboration' => Schema::TYPE_BOOLEAN . ' DEFAULT 1',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('settingsUserKey', '{{%settings}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}
