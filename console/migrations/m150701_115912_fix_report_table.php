<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_115912_fix_report_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->dropColumn('{{%report}}', 'reason');
        
        $this->createTable('{{%reason}}', [
            'id' => Schema::TYPE_PK,
            'text' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->createTable('{{%reportReason}}', [
            'id' => Schema::TYPE_PK,
            'idReason' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idReport' => Schema::TYPE_INTEGER . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('reportReasonReportKey', '{{%reportReason}}', 'idReport', '{{%report}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('reportReasonReasonKey', '{{%reportReason}}', 'idReason', '{{%reason}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //Not adding dropped columns back since there is no code that uses them in git yet.
        
        $this->dropTable('{{%reportReason}}');
        $this->dropTable('{{%reason}}');
    }
}
