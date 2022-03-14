<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        //
        $users = User::count();
        $voters = Voter::all();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('voter/index', compact('voters'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::count();
        $facultys = Faculty::all();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('voter/create', compact('facultys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'voter_name' => 'required',
            'matric_number' => 'required',
            'faculty' => 'required'
        ]);

        $voter = new Voter();
        $voter->name = $request->voter_name;
        $voter->matric_number = $request->matric_number;
        $voter->faculties_id	 = $request->faculty;
        $voter->save();

        return redirect(route('voters.index'))->with('success','Voter Successfully Added');
    }

    public function import(Request $request )
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
    public function edit(Voter $voter)
    {
        //
        $facultys = Faculty::all();
        $voter_faculty = Voter::find($voter->id)->faculty;
        $data = [
            'facultys' => $facultys,
            'voter' => $voter,
            'voter_faculty' => $voter,
        ];
        dd($data);
        return view('voter/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voter $voter)
    {
        //
        $this->validate($request,[
            'voter_name' => 'required',
            'matric_number' => 'required',
            'faculty' => 'required'
        ]);

        $voter->update(
            [
                'name' => $request->name,
                'matric_number' => $request->matric_number,
                'faculties_id	' => $request->faculty,
            ]
        );
        return redirect(route('voters.index'))->with('success','Voter Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voter $voter)
    {
        //
        $voter->delete();
        return redirect()->route('voters.index')->with('success','Voter Succesfully Deleted');
    }
}
