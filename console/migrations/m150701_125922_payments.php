<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_125922_payments extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%payments}}', [
            'id' => Schema::TYPE_PK,
            'amount' => Schema::TYPE_DECIMAL,
            'idUserSender' => Schema::TYPE_INTEGER,
            'transactionId' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_SMALLINT . ' DEFAULT 1',
            'description' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->createTable('{{%userReceivers}}', [
            'id' => Schema::TYPE_PK,
            'idUser' => Schema::TYPE_INTEGER,
            'idPyments' => Schema::TYPE_INTEGER,
            'amount' => Schema::TYPE_DECIMAL,
        ], $tableOptions);

        $this->addForeignKey('paymentsUserSender', '{{%payments}}', 'idUserSender', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('userReceiversUser', '{{%userReceivers}}', 'idUser', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('userReceiversPyments', '{{%userReceivers}}', 'idPyments', '{{%payments}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%payments}}');
        $this->dropTable('{{%userReceivers}}');
    }
}
