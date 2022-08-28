<?php


namespace App\Http\Controllers;

use App\Election;
use App\User;

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
        //
        $users = User::count();
        $elections = Election::all();
        // $widget = [
        //     'users' => $users,            
        //     'elections' => $elections,
        //     //...
        // ];
        // dd($elections);
        return view('election/index', compact('elections'));
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

        $widget = [
            'users' => $users,
            //...
        ];

        return view('election/create', compact('widget'));
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
        // dd($request->all());

        $this->validate($request,[
            'election_name' => 'required',
            'election_start_at' => 'required|date|before:election_end_at',
            'election_end_at' => 'required|date|after:election_start_at'
        ]);

        $election = new Election();

        $election->name = $request->election_name;
        $election->start_at = $request->election_start_at;
        $election->end_at = $request->election_end_at;
        $election->save();

        return redirect(route('elections.index'))->with('success','Election Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        //
        $users = User::count();
        // $election_detail = Election::find($election);
        $data = [
            'users' => $users,
            'election' => $election,
            //...
        ];

        return view('election/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election $election)
    {
        //
        // dd($request->input());
        $this->validate($request,[
            'election_name' => 'required',
            'election_start_at' => 'required|date|before:election_end_at',
            'election_end_at' => 'required|date|after:election_start_at'
        ]);

        $election->update(
            [
                'name'=> $request->election_name,
                // 'start_at'=> $request->election_start_at,
                'start_at'=> date('Y-m-d H:i', strtotime($request->election_start_at)),
                'end_at'=> date('Y-m-d H:i', strtotime($request->election_end_at)),
            ]
        );
        return redirect(route('elections.index'))->with('success','Election Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election)
    {
        //
        $election->delete();
        return redirect()->route('elections.index')->with('success','Election Succesfully Deleted');
    }
}
