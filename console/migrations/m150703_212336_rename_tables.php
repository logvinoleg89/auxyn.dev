<?php

use yii\db\Schema;
use yii\db\Migration;

class m150703_212336_rename_tables extends Migration
{
    public function up()
    {
        $this->renameTable('attenders', 'attender');
        $this->renameTable('messages', 'message');
    }

    public function down()
    {
       $this->renameTable('attender', 'attenders');
       $this->renameTable('message', 'messages');
    }
}
