<?php

namespace App\Jobs;

use App\ContributionPeriod;
use App\GroupSetting;
use App\Members;
use App\Notification;
use App\NotificationTypes;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OverdueContributionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //todo create pending payments for overdue contributions
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $settings = GroupSetting::whereContributions(1)->where('send_reminders', 1)->get();
        foreach ($settings as $setting){
            $period = ContributionPeriod::find($settings->contribution_periods_id);
            if (!$period) return;

            switch ($period->name){
                case 'daily':
                    $members = Members::whereGroupId($settings->group_id)->get();
                    if (Carbon::now()->diffInHours(Carbon::now()->endOfDay()) === 23)
                    foreach ($members as $member){
                        Notification::make([
                            'user_id' => $member->user_id,
                            'subject' => 'Contribution Reminder',
                            'message' => $period->name.' contribution of'.Wallet::whereUserId($member->user_id)->currencyShortDesc().' '.$setting->contribution_amount,
                            'notification_types_id' => NotificationTypes::getTypeId('REMINDERS'),
                        ]);
                    }
                    break;
                case 'weekly':
                    $members = Members::whereGroupId($settings->group_id)->get();
                    if (Carbon::now()->diffInDays(Carbon::now()->endOfWeek()) === 1)
                        foreach ($members as $member){
                            Notification::make([
                                'user_id' => $member->user_id,
                                'subject' => 'Contribution Reminder',
                                'message' => $period->name.' contribution of'.Wallet::whereUserId($member->user_id)->currencyShortDesc().' '.$setting->contribution_amount,
                                'notification_types_id' => NotificationTypes::getTypeId('REMINDERS'),
                            ]);
                        }
                    break;
                case 'monthly':
                    $members = Members::whereGroupId($settings->group_id)->get();
                    if (Carbon::now()->diffInDays(Carbon::now()->endOfMonth()) === 1)
                        foreach ($members as $member){
                            Notification::make([
                                'user_id' => $member->user_id,
                                'subject' => 'Contribution Reminder',
                                'message' => $period->name.' contribution of'.Wallet::whereUserId($member->user_id)->currencyShortDesc().' '.$setting->contribution_amount,
                                'notification_types_id' => NotificationTypes::getTypeId('REMINDERS'),
                            ]);
                        }
                    break;
                case 'quartely':
                    $members = Members::whereGroupId($settings->group_id)->get();
                    if (Carbon::now()->diffInDays(Carbon::now()->endOfQuarter()) === 1)
                        foreach ($members as $member){
                            Notification::make([
                                'user_id' => $member->user_id,
                                'subject' => 'Contribution Reminder',
                                'message' => $period->name.' contribution of'.Wallet::whereUserId($member->user_id)->currencyShortDesc().' '.$setting->contribution_amount,
                                'notification_types_id' => NotificationTypes::getTypeId('REMINDERS'),
                            ]);
                        }
                    break;
                case 'yearly':
                        $members = Members::whereGroupId($settings->group_id)->get();
                        if (Carbon::now()->diffInMonths(Carbon::now()->endOfYear()) === 1)
                            foreach ($members as $member){
                                Notification::make([
                                    'user_id' => $member->user_id,
                                    'subject' => 'Contribution Reminder',
                                    'message' => $period->name.' contribution of'.Wallet::whereUserId($member->user_id)->currencyShortDesc().' '.$setting->contribution_amount,
                                    'notification_types_id' => NotificationTypes::getTypeId('REMINDERS'),
                                ]);
                            }
                break;
            }
            echo $setting->id . ' <= Processed';
        }
        echo 'Running reminders completed';
    }
}
