<?php

namespace App\Http\Controllers\Api\V1\Contact;

use Validator;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Utility\Api\ApiCodes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class TicketController extends Controller
{
    /**
     * Create a new TicketController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResponseBuilder::error(ApiCodes::FORBIDDEN);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ResponseBuilder::error(ApiCodes::FORBIDDEN);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'message' => 'required|string|max:500',
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email:rfce|max:100|unique:users',
        ])->validate();

        if($contact = Contact::create($data)){
            $contact = [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'message' => $contact->message,
                'created_at' => $contact->created_at
            ];
        } else {
            return ResponseBuilder::error(ApiCodes::INTERNAL_SERVER_ERROR);
        }

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::CREATED)->withData($contact)->build()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = (Validator::make(
            ['id' => $id], ['id' => 'required|uuid'])->validate()
        );
        
        $contact = (Contact::where(
            'id',$data['id'])->first()
        );

        if($contact){
            $contact = [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'message' => $contact->message,
                'created_at' => $contact->created_at
            ];
        } else {
            return ResponseBuilder::error(ApiCodes::NOT_FOUND);
        }

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($contact)->build()
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return ResponseBuilder::error(ApiCodes::FORBIDDEN);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = (Validator::make(
            array_merge(['id' => $id],$request->all()), [
                'id' => 'required|uuid',
                'message' => 'required|string|max:500',
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email:rfce|max:100|unique:users',
            ])->validate()
        );

        $contact = (Contact::where(
            'id',$data['id'])->first()
        );

        if($contact){
            $contact->updated_at = now()->timestamp;
        } else {
            return ResponseBuilder::error(ApiCodes::NOT_FOUND);
        }

        if(!$contact->update(
            collect($data)->except('id')->toArray()
        )){
            return ResponseBuilder::error(ApiCodes::INTERNAL_SERVER_ERROR);
        }

        $contact = [
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'message' => $contact->message,
            'updated_at' => $contact->updated_at
        ];

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($contact)->build()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = (Validator::make(
            ['id' => $id], ['id' => 'required|uuid'])->validate()
        );
        
        $contact = (Contact::where(
            'id',$data['id'])->first()
        );

        if(!$contact){
            return ResponseBuilder::error(ApiCodes::NOT_FOUND);
        }

        $contact->delete();

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withMessage(
                Lang::get('backend.ticket deleted')
            )->build()
        );
    }
}
