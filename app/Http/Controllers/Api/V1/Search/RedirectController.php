<?php

namespace App\Http\Controllers\Api\V1\Search;

use Validator;
use App\Models\SubUrlAtlas;
use App\Models\RootUrlAtlas;
use Illuminate\Http\Request;
use App\Utility\Api\ApiCodes;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class RedirectController extends Controller
{
    /**
     * Create a new RedirectController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        if (!$request->hasValidSignature()) {
            return redirect('/error/'.ApiCodes::UNAUTHORIZED);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|uuid'
        ]);

        if ($validator->fails()) {
            return redirect('/error/'.ApiCodes::NOT_ACCEPTABLE);
        }

        $data = $validator->validated();

        if(!(
            $subUrl = SubUrlAtlas::find(
                $data['id']
            )
        )){
            return redirect('/error/'.ApiCodes::NOT_FOUND);
        }

        if(!(
            $rootUrl = RootUrlAtlas::find(
                $subUrl->root_url_id
            )
        )){
            return redirect('/error/'.ApiCodes::NOT_FOUND);
        }

        $subUrl->update([
            'visits' => $subUrl->visits + 1
        ]);

        return redirect()->away("//{$rootUrl->url}/{$subUrl->url}");
    }
}
