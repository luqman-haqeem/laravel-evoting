<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\User;
use App\Voter;
use App\Election;
use App\Section;
use App\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Element;
use Symfony\Component\Console\Input\Input;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($election)
    {
        //
        $users = User::count();
        $candidates = Candidate::whereElectionId($election)->get();
        // dd($candidates);
        $data = [
            'users' => $users,
            'candidates' => $candidates,
            'election' => $election,
        ];
        // dd($data['candidates']);
        return view('candidate/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($election)
    {
        //
        $users = User::count();

        $voters = Voter::query()->where('election_id',$election)->whereNotIn('id',function($query){
            $query->selectRaw('voter_id')->whereNull('deleted_at')->from('candidates');
        } )->get();

        
        $data = [
            'users' => $users,
            'election' => $election,
            'voters' => $voters,
            'sections' => Section::all(),

        ];

        return view('candidate/create', compact('data'));
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
        $this->validate($request, [
            'matric_number' => 'required|integer',
            'candidate_section' => 'required|integer',
            'candidate_motto' => 'required|string|max:255',
            'candidate_image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $candidate = new Candidate();
        $candidate->election_id = $election->id;
        $candidate->voter_id = $request->matric_number;
        $candidate->section_id = $request->candidate_section;
        $candidate->motto = $request->candidate_motto;

        if ($request->file('candidate_image')) {
            $file = $request->file('candidate_image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = date('YmdHi_') . $election->id . "_" . $request->matric_number . "." . $extension;
            $file->move(public_path().'/storage/candidate/', $filename);
            $data['image'] = $filename;
            $candidate->candidate_image = $filename;
        }
        $candidate->save();

        return redirect(route('candidates.index', $election))->with('success', 'Candidate Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election, Candidate $candidate)
    {
        //
        $users = User::count();
        // dd($candidate->voter_id);
        // $voter_Id = Candidate::find($candidate->voter_id)->voterId;
        // $section = Section::find($candidate->section_id)->section;
        // $imageUrl = $candidate->getMedia('candidate')->first()->getUrl();
        // $image_detail = $candidate->getMedia('candidate')->first();

        $data = [
            'users' => $users,
            'candidate' => $candidate,
            'election' => $election,
            // 'faculty' => $section,
        ];
        // dd($data);
        return view('candidate/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election $election, Candidate $candidate)
    {
        //
        $this->validate($request, [
            'matric_number' => 'required',
            'candidate_section' => 'required',
            'candidate_motto' => 'required',
            // 'candidate_image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);
        // dd($request);

        $candidate->election_id = $election->id;
        // $candidate->voter_id = $request->matric_number;
        $candidate->section_id = $request->candidate_section;
        $candidate->motto = $request->candidate_motto;
        $candidate->update();

        return redirect(route('candidates.index', $election))->with('success', 'Candidate Successfully Updated');
    }
    /**
     * Update the candidate image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update_image(Request $request, Election $election, Candidate $candidate)
    {
        // dd($request);

        $this->validate($request, [
            'candidate_image' => 'required|image'
        ]);

        // dd($request);    

        // dd($candidate->candidate_image);

        $old_img_path = public_path().'/storage/candidate/'.$candidate->candidate_image;
        if (Storage::exists($old_img_path)) {
            unlink($old_img_path); 
        }
        $file = $request->file('candidate_image');
        $extension = $file->getClientOriginalExtension(); 
        $filename = date('YmdHi_') . $election->id . "_" . $request->matric_number . "." . $extension;
        $file->move(public_path().'/storage/candidate/', $filename);
        $data['image'] = $filename;
        $candidate->candidate_image = $filename;
        $candidate->update();

        return redirect()->back()->with('success', 'Candidate Image Successfully Updated');
        // return redirect(route('candidates.edit', $election))->with('success', 'Candidate Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election, Candidate $candidate)
    {
        //
        $candidate->delete();
        return redirect()->route('candidates.index', $election)->with('success', 'Candidate Succesfully Deleted');
    }
}
