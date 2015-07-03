<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_143739_fix_radio_table extends Migration
{
    public function up()
    {

        $this->dropForeignKey('radioGenreKey', '{{%radio}}');
        $this->dropColumn('{{%radio}}', 'idGenre');

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%radioGenres}}', [
            'id' => Schema::TYPE_PK,
            'idGenre' => Schema::TYPE_INTEGER,
            'idRadio' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('radioGenresRadioKey', '{{%radioGenres}}', 'idRadio', '{{%radio}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('radioGenresGenreKey', '{{%radioGenres}}', 'idGenre', '{{%genre}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //Not adding dropped columns back since there is no code that uses them in git yet.
    }
}
