<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_133253_message extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%messages}}', [
            'id' => Schema::TYPE_PK,
            'idUserSender' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idUserReceiver' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idCollaboration' => Schema::TYPE_INTEGER,
            'idEvent' => Schema::TYPE_INTEGER,
            'idPhoto' => Schema::TYPE_INTEGER,
            'link' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_SMALLINT . ' DEFAULT 1',
            'subject' => Schema::TYPE_STRING,
            'text' => Schema::TYPE_STRING,
            'location' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->addForeignKey('messagesUserSenderKey', '{{%messages}}', 'idUserSender', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('messagesUserReceiverKey', '{{%messages}}', 'idUserReceiver', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('messagesCollaborationKey', '{{%messages}}', 'idCollaboration', '{{%collaboration}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('messagesEventKey', '{{%messages}}', 'idEvent', '{{%event}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('messagesPhotoKey', '{{%messages}}', 'idPhoto', '{{%photo}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%messages}}');
    }
}
