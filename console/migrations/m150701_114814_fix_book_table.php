<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_114814_fix_book_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%book}}', 'compensation');
        $this->dropColumn('{{%book}}', 'status');
        $this->addColumn('{{%book}}', 'compensation', Schema::TYPE_DECIMAL  . '(15,2)');
        $this->addColumn('{{%book}}', 'status', Schema::TYPE_SMALLINT . ' DEFAULT 2');
    }

    public function down()
    {
        //Not adding dropped columns back since there is no code that uses them in git yet.
    }
}
