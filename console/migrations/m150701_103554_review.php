<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_103554_review extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%review}}', [
            'id' => Schema::TYPE_PK,
            'idUserReviewer' => Schema::TYPE_INTEGER,
            'idUserReviewing' => Schema::TYPE_INTEGER,
            'idEvent' => Schema::TYPE_INTEGER,
            'text' => Schema::TYPE_STRING,
            'ratingAmount' => Schema::TYPE_INTEGER,
        ], $tableOptions);


        $this->addForeignKey('reviewUserReviewerKey', '{{%review}}', 'idUserReviewer', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('reviewUserReviewingKey', '{{%review}}', 'idUserReviewing', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('reviewEventKey', '{{%review}}', 'idEvent', '{{%event}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('{{%review}}');
    }
}
