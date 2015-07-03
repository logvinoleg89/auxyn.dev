<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_124940_radio extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%radio}}', [
            'id' => Schema::TYPE_PK,
            'idGenre' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
        ], $tableOptions);


        $this->addForeignKey('radioGenreKey', '{{%radio}}', 'idGenre', '{{%genre}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%radio}}');
    }
}
