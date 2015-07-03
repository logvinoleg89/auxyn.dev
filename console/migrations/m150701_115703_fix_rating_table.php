<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_115703_fix_rating_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%rating}}', 'ratingAmount');
        $this->addColumn('{{%rating}}', 'ratingAmount', Schema::TYPE_DECIMAL  . '(3,2)');
    }

    public function down()
    {
        //Not adding dropped columns back since there is no code that uses them in git yet.
    }
}
