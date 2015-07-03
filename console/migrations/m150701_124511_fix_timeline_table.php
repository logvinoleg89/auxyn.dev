<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_124511_fix_timeline_table extends Migration
{
    public function up()
    {        
        $this->dropColumn('{{%timeline}}', 'textLinks');
        $this->dropColumn('{{%timeline}}', 'images');
        $this->addColumn('{{%timeline}}', 'location', Schema::TYPE_STRING);
        $this->addColumn('{{%timeline}}', 'link', Schema::TYPE_STRING);
        $this->addColumn('{{%timeline}}', 'idPhoto', Schema::TYPE_INTEGER);
        
        $this->addForeignKey('timelinePhotoKey', '{{%timeline}}', 'idPhoto', '{{%photo}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //Not adding dropped columns back since there is no code that uses them in git yet.
    }
}
