<?php

namespace App\Http\Controllers\API;

use App\Election;
use App\Http\Controllers\Controller;
use App\Http\Resources\ElectionResource;
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
        return response()->json([ElectionResource::collection($data), 'Programs fetched.']);
    }
    
    public function show(Election $election)
    {
        # code...
    }

}
