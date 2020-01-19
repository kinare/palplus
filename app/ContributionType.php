<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class ContributionType extends BaseModel
{
    protected $fillable = [
        'group_id',
        'contribution_periods_id',
        'contribution_categories_id',
        'activity_id',
        'name',
        'description',
        'amount',
        'target_amount',
        'balance',
        'project_id',
        'membership_fee',
        'booking_fee',
        'type',
    ];

    public static function init(array $type) : self
    {
        $self = new self();
        $self->fill($type);
        $self->created_by = Auth::user()->id;
        $self->save();
        return $self;
    }

    public static function amend(array $type)
    {
        $self = self::where([
            'group_id' => $type['group_id'],
            'project_id' => $type['project_id']
        ]);

        if ($self){
            $self->modified_by = Auth::user()->id;
            $self->save();
            return $self;
        }
    }
}
