<?php

namespace App\Http\Controllers\API;

use App\Candidate;
use App\Election;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Election $election)
    {
        $candidates = Candidate::whereElectionId($election->id)->get();

        // dd($data);
        return response()->json([CandidateResource::collection($candidates)]);
    }
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election,Candidate $candidate)
    {
        if (is_null($candidate)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CandidateResource($candidate)]);
    }
}
