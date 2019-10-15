<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @SWG\Swagger(
 *   basePath="/api/",
 *   schemes={"http", "https"},
 *   @SWG\Info(
 *     title="Palplus UAA",
 *     description="Palplus Swagger API description",
 *     version="1.0.0",
 *     @SWG\Contact(
 *             email="michaelkinare@gmail.com"
 *         ),
 *   ),
 *
 * )
 *
 * @SWG\SecurityScheme(
 * securityDefinition="passport",
 * type="oauth2",
 * tokenUrl="/oauth/token",
 * flow="password",
 * scopes={}
 * )
 * */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
