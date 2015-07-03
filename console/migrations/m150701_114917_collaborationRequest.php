<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_114917_collaborationRequest extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%collaborationRequest}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idCollaboration' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' DEFAULT 2',
        ], $tableOptions);

        $this->addForeignKey('collaborationRequestUserKey', '{{%collaborationRequest}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('collaborationRequestCollaborationKey', '{{%collaborationRequest}}', 'idCollaboration', '{{%collaboration}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%collaborationRequest}}');
    }
}
