<?php

namespace App\Http\Controllers;

use App\Election;
use App\Faculty;
use App\Voter;
use App\User;

use Illuminate\Http\Request;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Election $election)
    {
        //
        $users = User::count();
        $voters = Voter::all();

        $data = [
            'users' => $users,
            'election' => $election,
            'voters' => $voters,
        ];
        return view('voter/index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Election $election)
    {
        //
        $users = User::count();
        $facultys = Faculty::all();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('voter/create', compact('facultys','election'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Election $election)
    {
        //
        $this->validate($request,[
            'voter_name' => 'required',
            'matric_number' => 'required',
            'faculty' => 'required'
        ]);

        $voter = new Voter();
        $voter->election_id = $election->id;
        $voter->name = $request->voter_name;
        $voter->matric_number = $request->matric_number;
        $voter->faculties_id  = $request->faculty;
        $voter->save();

        return redirect(route('voters.index',$election->id))->with('success','Voter Successfully Added');
    }

    public function import(Request $request ,Election $election)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function show(Voter $voter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election, Voter $voter)
    {
        //
        $facultys = Faculty::all();

        // dd($data);
        return view('voter/edit', compact('election','voter','facultys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election $election, Voter $voter)
    {
        //
        $this->validate($request,[
            'voter_name' => 'required',
            'matric_number' => 'required',
            'faculty' => 'required'
        ]);
        $voter->update(
            [
                'name' => $request->voter_name,
                'matric_number' => $request->matric_number,
                'faculties_id	' => $request->faculty,
            ]

        );
        dd($request);

        return redirect(route('voters.index',$election->id))->with('success','Voter Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election,Voter $voter)
    {
        //
        $voter->delete();
        return redirect()->route('voters.index',$election->id)->with('success','Voter Succesfully Deleted');
    }
}
