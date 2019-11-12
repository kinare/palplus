<?php

namespace App\Http\Controllers\Contributions;

use App\ContributionCategory;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ContributionCategoryResource;
use Illuminate\Http\Request;

class ContributionCategoryController extends BaseController
{
    public function __construct($model = ContributionCategory::class, $resource = ContributionCategoryResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/contribution/categories",
     *   tags={"Contributions"},
     *   summary="Retrieve Contribution Categories",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

}
