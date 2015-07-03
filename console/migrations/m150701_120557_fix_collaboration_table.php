<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_120557_fix_collaboration_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%collaboration}}', 'type');
        $this->dropColumn('{{%collaboration}}', 'status');
        $this->addColumn('{{%collaboration}}', 'status', Schema::TYPE_SMALLINT . ' DEFAULT 2');
        $this->addColumn('{{%collaboration}}', 'lookingFor', Schema::TYPE_SMALLINT . ' DEFAULT 1');
        $this->addColumn('{{%collaboration}}', 'iAm', Schema::TYPE_SMALLINT . ' DEFAULT 1');
    }

    public function down()
    {
        //Not adding dropped columns back since there is no code that uses them in git yet.
    }
}
