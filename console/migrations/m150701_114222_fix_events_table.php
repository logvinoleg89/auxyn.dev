<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_114222_fix_events_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->dropColumn('{{%event}}', 'piblic');
        $this->dropColumn('{{%event}}', 'eventType');
        $this->dropColumn('{{%event}}', 'genres');
        $this->addColumn('{{%event}}', 'isPublic', Schema::TYPE_BOOLEAN  . ' DEFAULT 1');
        $this->addColumn('{{%event}}', 'type', Schema::TYPE_STRING);
        
        $this->createTable('{{%eventGenre}}', [
            'id' => Schema::TYPE_PK,
            'idEvent' => Schema::TYPE_INTEGER . ' NOT NULL',
            'idGenre' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 10',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('eventGenreEventKey', '{{%eventGenre}}', 'idEvent', '{{%event}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('eventGenreGenreKey', '{{%eventGenre}}', 'idGenre', '{{%genre}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //Not adding dropped columns back since there is no code that uses them in git yet.
        
        $this->dropTable('{{%eventGenre}}');
    }
}
