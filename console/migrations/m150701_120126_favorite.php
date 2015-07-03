<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_120126_favorite extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%favorite}}', [
            'id' => Schema::TYPE_PK,
            'idUserFollower' => Schema::TYPE_INTEGER,
            'idUserFollowing' => Schema::TYPE_INTEGER,
        ], $tableOptions);


        $this->addForeignKey('favoriteUserFollowerKey', '{{%favorite}}', 'idUserFollower', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('favoriteUserFollowingKey', '{{%favorite}}', 'idUserFollowing', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%favorite}}');
    }
}
