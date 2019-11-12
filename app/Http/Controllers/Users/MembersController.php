<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembersController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Members::class, MemberResource::class);
    }

    /**
     * @SWG\Get(
     *   path="/member",
     *   tags={"Member"},
     *   summary="Retrieve Members",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Post(
     *   path="/member",
     *   tags={"Member"},
     *   summary="Create Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="Group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/member/{id}",
     *   tags={"Member"},
     *   summary="Update Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="query",description="Group Name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="Group Description",required=true,type="string"),
     *   @SWG\Parameter(name="access_level",in="query",description="access level",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/member/{id}",
     *   tags={"Member"},
     *   summary="Retrieve Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/member/{id}",
     *   tags={"Member"},
     *   summary="Delete Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/member/{id}/force",
     *   tags={"Member"},
     *   summary="Force delete Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Get(
     *   path="/member/activate{id}",
     *   tags={"Member"},
     *   summary="Activate Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function activate($id)
    {

    }

    /**
     * @SWG\Get(
     *   path="/member/deactivate{id}",
     *   tags={"Member"},
     *   summary="Deavtivate Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function deactivate($id)
    {

    }

    public static function member(array $data) : Members
    {
        $member = new Members();
        $member->group_id = $data['group_id'];
        $member->user_id = $data['user_id'];
        $member->created_by = Auth::user()->id;
        $member->save();
        return $member;
    }

    public static function isAdmin($group_id) : bool
    {
        return Members::where([
            'user_id' => Auth::user()->id,
            'group_id' => $group_id
        ])->first()->is_admin;


    }
}
