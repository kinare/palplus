<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class Notification extends BaseModel
{
    protected $fillable = [
      'user_id',
      'subject',
      'message',
      'payload',
      'status',
      'notification_types_id',
    ];
	/**
	 * undocumented function summary
	 *
	 * Undocumented function long description
	 *
	 * @param Type $Array notice
	 * @return type
	 * values  => subject, message, payload, notification_types_id, user_id
	 **/
    public static function make(array $notice) : self
    {
		// notic
        $self = new self();
        $self->fill($notice);
        $self->created_by = Auth::user()->id;
        $self->save();
        return $self;
    }

    public function read(){
        $this->status = 'inactive';
        $this->modified_by = Auth::user()->id;
        $this->save();
	}
}
