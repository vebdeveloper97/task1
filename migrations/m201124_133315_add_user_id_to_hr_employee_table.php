<?php

use yii\db\Migration;

/**
 * Class m201124_133315_add_user_id_to_hr_employee_table
 */
class m201124_133315_add_user_id_to_hr_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('hr_employee', 'user_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('hr_employee', 'user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201124_133315_add_user_id_to_hr_employee_table cannot be reverted.\n";

        return false;
    }
    */
}
