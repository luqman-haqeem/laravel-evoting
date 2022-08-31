<?php

namespace App\Http\Controllers\API;

use App\Election;
use App\Http\Controllers\Controller;
use App\Http\Resources\VoterResource;
use App\Voter;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Election $election)
    {
        $voters = Voter::where('election_id',$election->id)->get();
        return response()->json([VoterResource::collection($voters)]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election,Voter $voter)
    {
        if (is_null($voter)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new VoterResource($voter)]);
    }
}
