<?php


namespace App\Http\Controllers;

use App\Election;
use App\Faculty;
use App\MaxVote;
use App\Section;
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
        $sections = Section::all();

        $data = [
            'sections' => $sections,
        ];

        return view('election/create', compact('data'));
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
        // dd($request->input());
        $this->validate($request, [
            'election_name' => 'required',
            'date_range' => 'required',
            'GENERAL' => 'required|integer|min:1|max:99',
            'FPM' => 'required|integer|min:1|max:99',
            'FSTM' => 'required|integer|min:1|max:99',
            'FPPI' => 'required|integer|min:1|max:99',
            'FP' => 'required|integer|min:1|max:99',
            'FSU' => 'required|integer|min:1|max:99',
        ]);
        $date_range = explode(' - ', $request->date_range);

        $election = new Election();

        $election->name = $request->election_name;
        $election->start_at = date('Y-m-d H:i:s', strtotime($date_range[0]));
        $election->end_at = date('Y-m-d H:i:s', strtotime($date_range[1]));
        $election->save();

        // update max voter
        $sections  = Section::all();
        foreach ($sections as $section) {
            $maxvVote = MaxVote::updateOrCreate(
                ['election_id' => $election->id, 'sections_id' => $section->id],
                ['max_votes' => $request->input(strtoupper($section->name))]
            );
        }

        return redirect(route('elections.index'))->with('success', 'Election Successfully Added');
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
        $sectionWithMaxVote = Section::where('max_votes.election_id', $election->id)->join('max_votes', 'sections.id', '=', 'max_votes.sections_id')->get();
        // dd($sectionWithMaxVote[0]->max_votes);
        // $election_detail = Election::find($election);
        $data = [
            'sections' => $sectionWithMaxVote,
            'election' => $election,
        ];
        // dd($data['MaxVote']);
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
        $this->validate($request, [
            'election_name' => 'required',
            'date_range'    => 'required',
            'GENERAL'       => 'required|integer|min:1|max:99',
            'FPM'           => 'required|integer|min:1|max:99',
            'FSTM'          => 'required|integer|min:1|max:99',
            'FPPI'          => 'required|integer|min:1|max:99',
            'FP'            => 'required|integer|min:1|max:99',
            'FSU'           => 'required|integer|min:1|max:99',
        ]);

        // dd($request->input());

        $date_range = explode(' - ', $request->date_range);

        $election->update(
            [
                'name' => $request->election_name,
                // 'start_at'=> $request->election_start_at,
                'start_at' => date('Y-m-d H:i:s', strtotime($date_range[0])),
                'end_at' => date('Y-m-d H:i:s', strtotime($date_range[1])),
            ]
        );

        // update max voter
        $sections  = Section::all();
        foreach ($sections as $section) {
            $maxvVote = MaxVote::updateOrCreate(
                ['election_id' => $election->id, 'sections_id' => $section->id],
                ['max_votes' => $request->input(strtoupper($section->name))]
            );
        }

        return redirect(route('elections.index'))->with('success', 'Election Successfully Updated');
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
        return redirect()->route('elections.index')->with('success', 'Election Succesfully Deleted');
    }
}
