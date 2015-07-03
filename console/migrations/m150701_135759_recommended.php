<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_135759_recommended extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%recommended}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idUserBand' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idTrack' => Schema::TYPE_INTEGER,
            'amount' => Schema::TYPE_DECIMAL,
        ], $tableOptions);

        $this->addForeignKey('recommendedUserKey', '{{%recommended}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('recommendedUserBandKey', '{{%recommended}}', 'idUserBand', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('recommendedTrackKey', '{{%recommended}}', 'idTrack', '{{%track}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%recommended}}');
    }
}
