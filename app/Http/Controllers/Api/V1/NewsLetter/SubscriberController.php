<?php

namespace App\Http\Controllers\Api\V1\NewsLetter;

use Validator;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Utility\Api\ApiCodes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class SubscriberController extends Controller
{
    /**
     * Create a new SubscriberController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseBuilder::error(ApiCodes::FORBIDDEN);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ResponseBuilder::error(ApiCodes::FORBIDDEN);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email:rfce|max:100|unique:users',
        ])->validate();

        if(NewsLetter::where('email',$data['email'])->exists()){
            throw ValidationException::withMessages([
                'url' => Lang::get('backend.already subscribed')
            ]);
        }

        if($newsLetter = NewsLetter::create($data)){
            $newsLetter = [
                'id' => $newsLetter->id,
                'name' => $newsLetter->name,
                'email' => $newsLetter->email,
                'created_at' => $newsLetter->created_at
            ];
        } else {
            return ResponseBuilder::error(ApiCodes::INTERNAL_SERVER_ERROR);
        }

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::CREATED)->withData($newsLetter)->build()
        );
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $data = (Validator::make(
            ['id' => $id], ['id' => 'required|uuid'])->validate()
        );
        
        $newsLetter = (NewsLetter::where(
            'id',$data['id'])->first()
        );

        if($newsLetter){
            $newsLetter = [
                'id' => $newsLetter->id,
                'name' => $newsLetter->name,
                'email' => $newsLetter->email,
                'created_at' => $newsLetter->created_at
            ];
        } else {
            return ResponseBuilder::error(ApiCodes::NOT_FOUND);
        }

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($newsLetter)->build()
        );
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        return ResponseBuilder::error(ApiCodes::FORBIDDEN);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $data = (Validator::make(
            array_merge(['id' => $id],$request->all()), [
                'id' => 'required|uuid',
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email:rfce|max:100|unique:users',
            ])->validate()
        );

        $newsLetter = (NewsLetter::where(
            'id',$data['id'])->first()
        );

        if($newsLetter){
            $newsLetter->updated_at = now()->timestamp;
        } else {
            return ResponseBuilder::error(ApiCodes::NOT_FOUND);
        }

        if(!$newsLetter->update(
            collect($data)->except('id')->toArray()
        )){
            return ResponseBuilder::error(ApiCodes::INTERNAL_SERVER_ERROR);
        }

        $newsLetter = [
            'id' => $newsLetter->id,
            'name' => $newsLetter->name,
            'email' => $newsLetter->email,
            'updated_at' => $newsLetter->updated_at
        ];

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($newsLetter)->build()
        );
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $data = (Validator::make(
            ['id' => $id], ['id' => 'required|uuid'])->validate()
        );
        
        $newsLetter = (NewsLetter::where(
            'id',$data['id'])->first()
        );

        if(!$newsLetter){
            return ResponseBuilder::error(ApiCodes::NOT_FOUND);
        }

        $newsLetter->delete();

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withMessage(
                Lang::get('backend.subscriber deleted')
            )->build()
        );
    }
}
