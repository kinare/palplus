<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends BaseModel
{
    public static function add(User $user){

        $contact = Contact::where([
            'user_id' => \Auth::id(),
            'contact_user_id' => $user->id
        ])->first();

        if ($contact) return;

        $contact = new Contact();
        $contact->user_id = \Auth::id();
        $contact->contact_user_id = $user->id;
        $contact->created_by = \Auth::id();
        $contact->save();
    }
}
