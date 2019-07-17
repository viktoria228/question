<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question}}`.
 */
class m190717_073354_create_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'userId' => $this->integer(),
            'likes' => $this->integer(),
            'dislikes' => $this->integer(),
            'template' => $this->integer(),
            'agree' => $this->integer(),
            'stop' => $this->integer(),
            'against' => $this->integer(),
            'countUser' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}
