<?php

namespace App\Http\Controllers\Api\V1\Search;

use Validator;
use App\Models\SubUrlAtlas;
use Illuminate\Http\Request;
use App\Utility\Api\ApiCodes;
use App\Http\Controllers\Controller;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class SuggestionController extends Controller
{
    /**
     * Create a new SuggestionController instance.
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
    public function suggest(Request $request)
    {
        $data = Validator::make($request->all(), [
            'total' => 'required|numeric|min:0|max:100',
            'searchTerm' => 'required|string|min:1',
        ])->validate();

        $suggestions = SubUrlAtlas::where(
            'sub_url_atlas.title', 'LIKE', "%{$data['searchTerm']}%"
        )->orWhere(
            'sub_url_atlas.keywords', 'LIKE', "%{$data['searchTerm']}%"
        )->leftJoin('root_url_atlas', 
            function ($join) {
                $join->on(
                    'sub_url_atlas.root_url_id', '=', 'root_url_atlas.id'
                );
            }
        )->select([
            "sub_url_atlas.id",
            "sub_url_atlas.url",
            "sub_url_atlas.type",
            "sub_url_atlas.title",
            "sub_url_atlas.created_at",
            "root_url_atlas.url as root_url"
        ])->limit($data['total'])->get()->map(function ($value) {
            return [
                "id" => $value->id,
                "type" => $value->type,
                "title" => $value->title,
                "url" => $value->root_url."/".$value->url,
                "created_at" => $value->created_at,
            ];
        })->toArray();

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($suggestions)->build()
        );
    }
}
