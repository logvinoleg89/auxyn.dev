<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_122804_add_photo_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%photo}}', [
            'id' => Schema::TYPE_PK,
            'file' => Schema::TYPE_STRING . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->createTable('{{%photoUser}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idPhoto' => Schema::TYPE_INTEGER . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('photoUserUserKey', '{{%photoUser}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('photoUserPhotoKey', '{{%photoUser}}', 'idPhoto', '{{%photo}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('userPhotoKey', '{{%user}}', 'mainPhoto', '{{%photo}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('userPhotoKey', '{{%user}}');
        $this->dropTable('{{%photoUser}}');
        $this->dropTable('{{%photo}}');
    }
}
