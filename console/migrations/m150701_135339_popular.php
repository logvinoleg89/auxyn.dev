<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_135339_popular extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%popular}}', [
            'id' => Schema::TYPE_PK,
            'idTrack' => Schema::TYPE_INTEGER . ' NOT NULL',
            'amount' => Schema::TYPE_DECIMAL,
        ], $tableOptions);

        $this->addForeignKey('popularTrackKey', '{{%popular}}', 'idTrack', '{{%track}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%popular}}');
    }
}
