<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_employee}}`.
 */
class m201124_125408_create_hr_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_employee}}', [
            'id' => $this->primaryKey(),
            'fish' => $this->char(100)->notNull(),
            'email' => $this->char(100),
            'phone' => $this->char(15)->notNull(),
            'pasport_series' => $this->char(25)->notNull(),
            'images' => $this->char(255),
            'brith_date' => $this->date()->notNull(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hr_employee}}');
    }
}
