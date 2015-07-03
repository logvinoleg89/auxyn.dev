<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_092020_add_genres_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%genre}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->createTable('{{%userGenre}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idGenre' => Schema::TYPE_INTEGER . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('userGenreUserKey', '{{%userGenre}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('userGenreGenreKey', '{{%userGenre}}', 'idGenre', '{{%genre}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%userGenre}}');
        $this->dropTable('{{%genre}}');
    }
}
