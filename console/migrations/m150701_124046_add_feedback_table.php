<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_124046_add_feedback_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER,
            'text' => Schema::TYPE_STRING,
            'link' => Schema::TYPE_STRING,
            'idPhoto' => Schema::TYPE_INTEGER,
        ], $tableOptions);
        
        $this->addForeignKey('feedbackUserKey', '{{%feedback}}', 'idUser', '{{%user}}', 'id', 'cascade', 'cascade');
        
        $this->addForeignKey('feedbackPhotoKey', '{{%feedback}}', 'idPhoto', '{{%photo}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%feedback}}');
    }
}
