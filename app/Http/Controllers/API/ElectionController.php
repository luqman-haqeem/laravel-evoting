<?php

namespace App\Http\Controllers\API;

use App\Election;
use App\Http\Controllers\Controller;
use App\Http\Resources\ElectionResource;
use Validator;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Election::latest()->get();

        return response()->json([ElectionResource::collection($data)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $election = Election::find($id);
        if (is_null($election)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new ElectionResource($election)]);
    }

}
