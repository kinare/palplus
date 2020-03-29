<?php

namespace App\Http\Controllers\Contact;

use App\Contact;
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
        $contacts = $request->contacts; //'[+254708338855,+2544545544]'; //

        $contacts = trim($contacts, '[');
        $contacts = trim($contacts, ']');
        $contacts = explode(',', $contacts);
        $matched = [];
        $users = User::all();
        foreach ($contacts as $contact){
            foreach ($users as $user){
                if (self::sanitize($user->phone) === self::sanitize($contact))
                    array_push($matched, $user->id);
            }
        }
        return UserResource::collection(User::whereIn('id', $matched)->get());
    }

    public static function sanitize(string $phone) : string
    {
        return substr($phone, -9);
    }

    /**
     * @SWG\Post(
     *   path="/contact/search",
     *   tags={"Contact"},
     *   summary="Search Contact",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="phone",in="query",description="phone no",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function search(Request $request){
        $users = User::all();
        foreach ($users as $user){
            if (self::sanitize($user->phone) === self::sanitize($request->phone)){
                Contact::add($user);
                return new UserResource($user);
            }
        }

        return response()->json([
            'message' => 'No user found'
        ], 404);
    }

    /**
     * @SWG\Get(
     *   path="/contact/contact-list",
     *   tags={"Contact"},
     *   summary="My contact list",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function myContactList(Request $request){
        $contacts = Contact::whereUserId($request->user()->id)->get();
        $ids = [];
        foreach ($contacts as $contact){
            array_push($ids, $contact->contact_user_id);
        }
        return UserResource::collection(User::whereIn('id', $ids)->get());
    }
}
