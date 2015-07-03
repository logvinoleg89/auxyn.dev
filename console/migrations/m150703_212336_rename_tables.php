<?php

use yii\db\Schema;
use yii\db\Migration;

class m150703_212336_rename_tables extends Migration
{
    public function up()
    {
        $this->renameTable('attenders', 'attender');
        $this->renameTable('messages', 'message');
        $this->renameTable('payments', 'payment');
    }

    public function down()
    {
       $this->renameTable('attender', 'attenders');
       $this->renameTable('message', 'messages');
       $this->renameTable('payment', 'payments');
    }
}
