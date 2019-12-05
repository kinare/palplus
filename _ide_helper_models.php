<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Account
 *
 * @property int $id
 * @property string $user_id
 * @property int $account_type_id
 * @property string $number
 * @property string|null $name
 * @property string|null $address
 * @property string|null $country
 * @property string|null $cvv
 * @property float|null $limit
 * @property string|null $expiry
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCvv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUserId($value)
 */
	class Account extends \Eloquent {}
}

namespace App{
/**
 * App\AccountType
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereUpdatedAt($value)
 */
	class AccountType extends \Eloquent {}
}

namespace App{
/**
 * App\ActivityContacts
 *
 * @property int $id
 * @property int $activity_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $location
 * @property string|null $phone
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityContacts whereUpdatedAt($value)
 */
	class ActivityContacts extends \Eloquent {}
}

namespace App{
/**
 * App\ActivityMembers
 *
 * @property int $id
 * @property int $group_id
 * @property int $member_id
 * @property int $activity_id
 * @property string $status
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityMembers whereUpdatedAt($value)
 */
	class ActivityMembers extends \Eloquent {}
}

namespace App{
/**
 * App\ActivityType
 *
 * @property int $id
 * @property string $activity
 * @property string|null $description
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityType whereUpdatedAt($value)
 */
	class ActivityType extends \Eloquent {}
}

namespace App{
/**
 * App\Admin
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string $email
 * @property string|null $password
 * @property string $access_type
 * @property string|null $invitation_token
 * @property string|null $wef
 * @property string|null $wet
 * @property string $avatar
 * @property int|null $phone_verified
 * @property string|null $phone_verified_at
 * @property int $active
 * @property int $email_verified
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereAccessType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmailVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereInvitationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePhoneVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereWef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereWet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Admin withoutTrashed()
 */
	class Admin extends \Eloquent {}
}

namespace App{
/**
 * App\ApprovalEntries
 *
 * @property int $id
 * @property int $approver_type_id
 * @property int $member_id
 * @property string $status
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereApproverTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovalEntries whereUpdatedAt($value)
 */
	class ApprovalEntries extends \Eloquent {}
}

namespace App{
/**
 * App\Approver
 *
 * @property int $id
 * @property int $member_id
 * @property int $group_id
 * @property int $approver_type_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Members $members
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereApproverTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Approver whereUpdatedAt($value)
 */
	class Approver extends \Eloquent {}
}

namespace App{
/**
 * App\ApproverTypes
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApproverTypes whereUpdatedAt($value)
 */
	class ApproverTypes extends \Eloquent {}
}

namespace App{
/**
 * App\BaseModel
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\BaseModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\BaseModel withoutTrashed()
 */
	class BaseModel extends \Eloquent {}
}

namespace App{
/**
 * App\Chat
 *
 * @property int $id
 * @property int $group_id
 * @property int $from
 * @property int $to
 * @property string $message
 * @property string $status
 * @property string|null $delivered_at
 * @property string|null $read_at
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereDeliveredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chat whereUpdatedAt($value)
 */
	class Chat extends \Eloquent {}
}

namespace App{
/**
 * App\Contribution
 *
 * @property int $id
 * @property int $contribution_types_id
 * @property int $group_id
 * @property int $member_id
 * @property float $amount
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Group $group
 * @property-read \App\ContributionType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereContributionTypesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contribution whereUpdatedAt($value)
 */
	class Contribution extends \Eloquent {}
}

namespace App{
/**
 * App\ContributionCategory
 *
 * @property int $id
 * @property string $category
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionCategory whereUpdatedAt($value)
 */
	class ContributionCategory extends \Eloquent {}
}

namespace App{
/**
 * App\ContributionPeriod
 *
 * @property int $id
 * @property string $name
 * @property string $length
 * @property string $period
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionPeriod whereUpdatedAt($value)
 */
	class ContributionPeriod extends \Eloquent {}
}

namespace App{
/**
 * App\ContributionType
 *
 * @property int $id
 * @property int $group_id
 * @property int|null $contribution_periods_id
 * @property int|null $contribution_categories_id
 * @property int|null $activity_id
 * @property int|null $project_id
 * @property string $name
 * @property string|null $description
 * @property float|null $amount
 * @property float|null $target_amount
 * @property float|null $balance
 * @property int $membership_fee
 * @property int $booking_fee
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereBookingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereContributionCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereContributionPeriodsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereMembershipFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereTargetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContributionType whereUpdatedAt($value)
 */
	class ContributionType extends \Eloquent {}
}

namespace App{
/**
 * App\Currency
 *
 * @property int $id
 * @property string $currency
 * @property string $short_description
 * @property string $country
 * @property float $rate
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App{
/**
 * App\Gender
 *
 * @property int $id
 * @property string $gender
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gender whereUpdatedAt($value)
 */
	class Gender extends \Eloquent {}
}

namespace App{
/**
 * App\Group
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string|null $avatar
 * @property string $access_level
 * @property string $country
 * @property float|null $target_amount
 * @property int $currency_id
 * @property int $type_id
 * @property int|null $setting_id
 * @property int|null $loan_setting_id
 * @property int|null $withdrawal_setting_id
 * @property int|null $wallet_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GroupActivity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Approver[] $approvers
 * @property-read int|null $approvers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GroupAttachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read mixed $avatar_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invitation[] $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Members[] $members
 * @property-read int|null $members_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GroupSetting[] $settings
 * @property-read int|null $settings_count
 * @property-read \App\GroupType $type
 * @property-read \App\Wallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereAccessLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereLoanSettingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereSettingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereTargetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereWalletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereWithdrawalSettingId($value)
 */
	class Group extends \Eloquent {}
}

namespace App{
/**
 * App\GroupActivity
 *
 * @property int $id
 * @property int $group_id
 * @property int $activity_type_id
 * @property string $name
 * @property string|null $description
 * @property string|null $avatar
 * @property string|null $itinerary
 * @property string|null $contacts
 * @property string $start_date
 * @property string $end_date
 * @property string|null $cut_off_date
 * @property int|null $slots
 * @property int $has_contributions
 * @property int $featured
 * @property int $booking_fee
 * @property int $installments
 * @property int|null $no_of_installments
 * @property float $booking_fee_amount
 * @property float $instalment_amount
 * @property float|null $total_cost
 * @property string|null $created_by
 * @property string|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $avatar_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereActivityTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereBookingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereBookingFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereContacts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereCutOffDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereHasContributions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereInstallments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereInstalmentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereItinerary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereNoOfInstallments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereSlots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupActivity whereUpdatedAt($value)
 */
	class GroupActivity extends \Eloquent {}
}

namespace App{
/**
 * App\GroupAttachment
 *
 * @property int $id
 * @property int $group_id
 * @property string $attachment
 * @property string $path
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttachment whereUpdatedAt($value)
 */
	class GroupAttachment extends \Eloquent {}
}

namespace App{
/**
 * App\GroupExpense
 *
 * @property int $id
 * @property int $group_id
 * @property int $activity_id
 * @property int|null $supplier_id
 * @property string $date
 * @property string|null $description
 * @property string|null $location
 * @property float $amount
 * @property string|null $document_no
 * @property float $total
 * @property mixed|null $photo
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereDocumentNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupExpense whereUpdatedAt($value)
 */
	class GroupExpense extends \Eloquent {}
}

namespace App{
/**
 * App\GroupProject
 *
 * @property int $id
 * @property int $group_id
 * @property string $name
 * @property string|null $description
 * @property float|null $estimated_cost
 * @property float|null $actual_cost
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $location
 * @property int $allow_contributions
 * @property float|null $contribution_amount
 * @property int|null $contribution_frequency
 * @property int $enable_reminders
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereActualCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereAllowContributions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereContributionAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereContributionFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereEnableReminders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereEstimatedCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupProject whereUpdatedAt($value)
 */
	class GroupProject extends \Eloquent {}
}

namespace App{
/**
 * App\GroupRequests
 *
 * @property int $id
 * @property int $group_id
 * @property int $user_id
 * @property string $status
 * @property string $request_code
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereRequestCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRequests whereUserId($value)
 */
	class GroupRequests extends \Eloquent {}
}

namespace App{
/**
 * App\GroupSetting
 *
 * @property int $id
 * @property int $group_id
 * @property int $membership_fee
 * @property float $membership_fee_amount
 * @property int $contributions
 * @property int|null $contribution_periods_id
 * @property int|null $contribution_categories_id
 * @property float|null $contribution_amount
 * @property float|null $contribution_target_amount
 * @property int $send_reminders
 * @property int $fixed_late_penalty
 * @property float $late_penalty_rate
 * @property float $late_penalty_amount
 * @property float $leaving_group_fee
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Group $group
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereContributionAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereContributionCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereContributionPeriodsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereContributionTargetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereContributions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereFixedLatePenalty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereLatePenaltyAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereLatePenaltyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereLeavingGroupFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereMembershipFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereMembershipFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereSendReminders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupSetting whereUpdatedAt($value)
 */
	class GroupSetting extends \Eloquent {}
}

namespace App{
/**
 * App\GroupType
 *
 * @property int $id
 * @property string $type
 * @property string|null $description
 * @property string|null $created_by
 * @property string|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupType whereUpdatedAt($value)
 */
	class GroupType extends \Eloquent {}
}

namespace App{
/**
 * App\InvestmentOpportunity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property int $featured
 * @property int $amount
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $avatar_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InvestmentOpportunity whereUpdatedAt($value)
 */
	class InvestmentOpportunity extends \Eloquent {}
}

namespace App{
/**
 * App\Invitation
 *
 * @property int $id
 * @property string $invitation_code
 * @property int $group_id
 * @property int $user_id
 * @property string|null $phone
 * @property string $status
 * @property string|null $expiry_date
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereInvitationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invitation whereUserId($value)
 */
	class Invitation extends \Eloquent {}
}

namespace App{
/**
 * App\Itinerary
 *
 * @property int $id
 * @property int $activity_id
 * @property string|null $description
 * @property string|null $location
 * @property string|null $date
 * @property string|null $time
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Itinerary whereUpdatedAt($value)
 */
	class Itinerary extends \Eloquent {}
}

namespace App{
/**
 * App\Loan
 *
 * @property int $id
 * @property string $code
 * @property int $member_id
 * @property int $group_id
 * @property string $status
 * @property int $approvals
 * @property float $payment_period
 * @property float $loan_amount
 * @property float $paid_amount
 * @property float $balance_amount
 * @property string $start_date
 * @property string $end_date
 * @property int $overdue
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereApprovals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereBalanceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereLoanAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereOverdue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan wherePaymentPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Loan whereUpdatedAt($value)
 */
	class Loan extends \Eloquent {}
}

namespace App{
/**
 * App\LoanApprovalEntry
 *
 * @property int $id
 * @property int $loan_id
 * @property int $approver_id
 * @property string $status
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereApproverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanApprovalEntry whereUpdatedAt($value)
 */
	class LoanApprovalEntry extends \Eloquent {}
}

namespace App{
/**
 * App\LoanPeriod
 *
 * @property int $id
 * @property string $period
 * @property int $days
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanPeriod whereUpdatedAt($value)
 */
	class LoanPeriod extends \Eloquent {}
}

namespace App{
/**
 * App\LoanSetting
 *
 * @property int $id
 * @property int $group_id
 * @property float $qualification_period
 * @property float $repayment_period
 * @property int $fixed_amount
 * @property float|null $limit_rate
 * @property float|null $limit_amount
 * @property float $interest_rate
 * @property int $fixed_late_payment
 * @property float|null $late_payment_rate
 * @property float|null $late_payment_amount
 * @property int $show_loans
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\LoanPeriod $period
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereFixedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereFixedLatePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereInterestRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereLatePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereLatePaymentRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereLimitAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereLimitRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereQualificationPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereRepaymentPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereShowLoans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanSetting whereUpdatedAt($value)
 */
	class LoanSetting extends \Eloquent {}
}

namespace App{
/**
 * App\LoanStatus
 *
 * @property int $id
 * @property string $status
 * @property string $description
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanStatus whereUpdatedAt($value)
 */
	class LoanStatus extends \Eloquent {}
}

namespace App{
/**
 * App\Members
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 * @property int $is_admin
 * @property int $loan_approver
 * @property int $withdrawal_approver
 * @property int $active
 * @property string|null $created_by
 * @property string|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereLoanApprover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Members whereWithdrawalApprover($value)
 */
	class Members extends \Eloquent {}
}

namespace App{
/**
 * App\MemberSetting
 *
 * @property int $id
 * @property int $notification
 * @property int $seen
 * @property string $wallpaper
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberSetting whereWallpaper($value)
 */
	class MemberSetting extends \Eloquent {}
}

namespace App{
/**
 * App\NextOfKin
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $gender
 * @property string $dob
 * @property string|null $relationship
 * @property string|null $phone
 * @property string|null $email
 * @property string $physical_address
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin wherePhysicalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NextOfKin whereUserId($value)
 */
	class NextOfKin extends \Eloquent {}
}

namespace App{
/**
 * App\Notification
 *
 * @property int $id
 * @property int $user_id
 * @property int $notification_types_id
 * @property string|null $subject
 * @property string|null $message
 * @property string|null $payload
 * @property string $status
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereNotificationTypesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereUserId($value)
 */
	class Notification extends \Eloquent {}
}

namespace App{
/**
 * App\NotificationTypes
 *
 * @property int $id
 * @property string $type
 * @property string|null $description
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationTypes whereUpdatedAt($value)
 */
	class NotificationTypes extends \Eloquent {}
}

namespace App{
/**
 * App\PasswordReset
 *
 * @property int $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereUpdatedAt($value)
 */
	class PasswordReset extends \Eloquent {}
}

namespace App{
/**
 * App\Payment
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $description
 * @property string|null $model
 * @property string|null $model_id
 * @property string|null $transaction_code
 * @property float $amount
 * @property string $status
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment status($args)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereTransactionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUserId($value)
 */
	class Payment extends \Eloquent {}
}

namespace App{
/**
 * App\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string $dob
 * @property string $gender
 * @property string $physical_address
 * @property string|null $avatar
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $avatar_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile wherePhysicalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUserId($value)
 */
	class Profile extends \Eloquent {}
}

namespace App{
/**
 * App\Suppliers
 *
 * @property int $id
 * @property string $name
 * @property string|null $location
 * @property string|null $description
 * @property string $phone
 * @property string|null $email
 * @property string $currency
 * @property float $amount_paid
 * @property float $amount_pending
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereAmountPending($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Suppliers whereUpdatedAt($value)
 */
	class Suppliers extends \Eloquent {}
}

namespace App{
/**
 * App\Transaction
 *
 * @property int $id
 * @property int $wallet_id
 * @property string $type
 * @property string|null $transaction_code
 * @property string|null $account_no
 * @property string|null $description
 * @property string|null $model
 * @property int|null $model_id
 * @property float $amount
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereTransactionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereWalletId($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property string|null $country_code
 * @property int $currency_id
 * @property string|null $location
 * @property int $active
 * @property int $phone_verified
 * @property string|null $verification_code
 * @property int $is_admin
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Account $accounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Loan[] $loans
 * @property-read int|null $loans_count
 * @property-read \App\NextOfKin $nok
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \App\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Wallet $wallet
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereVerificationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Wallet
 *
 * @property int $id
 * @property string $type
 * @property int|null $user_id
 * @property int|null $group_id
 * @property int $currency_id
 * @property float $total_balance
 * @property float $total_deposits
 * @property float $total_withdrawals
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereTotalBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereTotalDeposits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereTotalWithdrawals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wallet whereUserId($value)
 */
	class Wallet extends \Eloquent {}
}

namespace App{
/**
 * App\Withdrawal
 *
 * @property int $id
 * @property string $code
 * @property int $group_id
 * @property int $member_id
 * @property int $approvers
 * @property float $amount
 * @property string $status
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereApprovers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereUpdatedAt($value)
 */
	class Withdrawal extends \Eloquent {}
}

namespace App{
/**
 * App\WithdrawalApprovalEntry
 *
 * @property int $id
 * @property int $withdrawal_id
 * @property int $approver_id
 * @property string $status
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereApproverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalApprovalEntry whereWithdrawalId($value)
 */
	class WithdrawalApprovalEntry extends \Eloquent {}
}

namespace App{
/**
 * App\WithdrawalSetting
 *
 * @property int $id
 * @property int $group_id
 * @property string $qualification_period
 * @property int $show_withdrawal
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereQualificationPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereShowWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WithdrawalSetting whereUpdatedAt($value)
 */
	class WithdrawalSetting extends \Eloquent {}
}

