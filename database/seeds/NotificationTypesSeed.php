<?php

use Illuminate\Database\Seeder;

class NotificationTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\NotificationTypes::truncate();
        \App\NotificationTypes::insert([
            ['type' => 'LOAN', 'description' => 'Loan notifications'],
            ['type' => 'WITHDRAWAL', 'description' => 'Withdrawal notifications'],
            ['type' => 'APPROVAL', 'description' => 'Approval notifications'],
            ['type' => 'INVITATION', 'description' => 'Group/Event Invitation notifications'],
            ['type' => 'PAYMENT', 'description' => 'Payment notifications'],
            ['type' => 'REMINDERS', 'description' => 'Reminder notices'],
        ]);
    }
}
