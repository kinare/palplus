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

    public static function make(array $notice) : self
    {
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
