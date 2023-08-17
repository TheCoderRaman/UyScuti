<?php

namespace App\Http\Controllers\Api\V1\Search;

use Validator;
use App\Models\SubUrlAtlas;
use Illuminate\Http\Request;
use App\Utility\Api\ApiCodes;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class ResultController extends Controller
{
    /**
     * Create a new ResultController instance.
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
    public function result(Request $request)
    {
        $data = Validator::make($request->all(), [
            'searchTerm' => 'bail|sometimes',
            'label' => 'required|string|min:1|max:100',
            'total' => 'required|numeric|min:0|max:100',
        ])->validate();

        $result = SubUrlAtlas::where(function($q) use($data){
            $q->where('sub_url_atlas.title', 'LIKE', "%{$data['searchTerm']}%")
              ->orWhere('sub_url_atlas.keywords', 'LIKE', "%{$data['searchTerm']}%");
        })->where(
            'sub_url_atlas.type', $data['label']
        )->leftJoin('root_url_atlas',
            function ($join) {
                $join->on(
                    'sub_url_atlas.root_url_id', '=', 'root_url_atlas.id'
                );
            }
        )->select([
            // Sub url data
            "sub_url_atlas.id as sub_id",
            "sub_url_atlas.url as sub_url",
            "sub_url_atlas.type as sub_type",
            "sub_url_atlas.title as sub_title",
            "sub_url_atlas.devices as sub_devices",
            "sub_url_atlas.keywords as sub_keywords",
            "sub_url_atlas.from_Url as sub_from_url",
            "sub_url_atlas.created_at as sub_created_at",
            "sub_url_atlas.updated_at as sub_updated_at",
            "sub_url_atlas.modified_at as sub_modified_at",
            "sub_url_atlas.description as sub_description",

            // Root url data
            "root_url_atlas.id as root_id",
            "root_url_atlas.url as root_url",
            "root_url_atlas.title as root_title",
            "root_url_atlas.favicon as root_favicon",
            "root_url_atlas.created_at as root_created_at",
            "root_url_atlas.updated_at as root_updated_at",
            "root_url_atlas.modified_at as root_modified_at",
            "root_url_atlas.description as root_description",
        ])->limit($data['total'])->paginate()->through(function ($value) {
            return [
                "sub_url" => [
                    "id" => $value->sub_id,
                    "url" => $value->sub_url,
                    "type" => $value->sub_type,
                    "title" => $value->sub_title,
                    "devices" => $value->sub_devices,
                    "from_url" => $value->sub_from_url,
                    "created_at" => $value->sub_created_at,
                    "updated_at" => $value->sub_updated_at,
                    "modified_at" => $value->sub_modified_at,
                    "description" => $value->sub_description,
                ],
                "root_url" => [
                    "id" => $value->root_id,
                    "url" => $value->root_url,
                    "title" => $value->root_title,
                    "favicon" => $value->root_favicon,
                    "created_at" => $value->root_created_at,
                    "updated_at" => $value->root_updated_at,
                    "modified_at" => $value->root_modified_at,
                    "description" => $value->root_description,
                ],
                "redirect" => URL::temporarySignedRoute(
                    'v1#api.search.redirect', now()->addDays(1), [
                        'id' => $value->sub_id
                    ]
                )
            ];
        })->toArray();

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($result)->build()
        );
    }
}
