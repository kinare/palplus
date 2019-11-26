<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * @SWG\Post(
     *   path="/contact/my-contacts",
     *   tags={"Contact"},
     *   summary="My Contacts",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="contacts",in="query",description="Contact array",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function myContacts(Request $request){
        $contacts = $request->contacts;
        $phones = [];
        $matched = [];
        $users = User::all();
        foreach ($contacts as $contact){
            foreach ($users as $user){
                if ($this->sanitize($user->phone) === $this->sanitize($contact))
                    array_push($matched, $user->id);
            }
        }
        return UserResource::collection(User::whereIn('id', $matched)->get());
    }

    private function sanitize(string $phone) : string
    {
        return substr($phone, -9);
    }
}
