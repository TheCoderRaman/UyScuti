<?php

namespace App\Http\Controllers\Api\V1\Search;

use Validator;
use App\Models\SubUrlAtlas;
use Illuminate\Http\Request;
use App\Utility\Api\ApiCodes;
use App\Http\Controllers\Controller;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class LabelController extends Controller
{
    /**
     * Create a new LabelController instance.
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
    public function label(Request $request)
    {
        $data = Validator::make($request->all(), [
            'total' => 'required|numeric|min:0|max:100'
        ])->validate();

        $labels = (SubUrlAtlas::select('type')
            ->distinct()->limit(
                $data['total']
            )->get()->map(
                fn($value) => [$value->type]
            )->flatten()->toArray()
        );

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($labels)->build()
        );
    }
}
