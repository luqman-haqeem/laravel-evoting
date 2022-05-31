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
        // $candidates = Candidate::all();
        $candidates = Candidate::whereElectionId($election)->get();

        $data = [
            'users' => $users,
            'candidates' => $candidates,
            'election' => $election,
            //...
        ];

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
        // $voter = Voter::whereNotIn('id',function($query){
        //     $query->selectRaw('voter_id')->where('election_id','=','$election')->from('candidates');
        // } )->get();
        $voters = Voter::notCandidatefor($election);
        $data = [
            'users' => $users,
            'election' => $election,
            'voters' => $voters,

            //...
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
        // dd($request);
        $this->validate($request,[
            'matric_number' => 'required',
            'candidate_section' => 'required',
            'candidate_motto' => 'required',
            // 'candidate_image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $candidate = new Candidate();
        $candidate->election_id = $election->id;
        $candidate->voter_id = $request->matric_number;
        $candidate->section_id = $request->candidate_section;
        $candidate->motto = $request->candidate_motto;
        $candidate->save();

        $temporaryImage = TemporaryImage::where('folder',$request->candidate_image)->first();
       
        if ($temporaryImage) {
            $tempPath = 'app/public/TemporaryImage/tmp/'. $request->candidate_image . '/' . $temporaryImage->filename;
 
            $permanentImagePath = 'app/public/candidates/'.$temporaryImage->filename;
            $candidate->addMedia(storage_path($tempPath))->toMediaCollection('candidate');
            // Storage::move($tempPath , $permanentImagePath);

            // $candidate->image = $permanentImagePath;

            rmdir(storage_path('app/public/TemporaryImage/tmp/'. $request->candidate_image));
            $temporaryImage->delete();
        }


        return redirect(route('candidates.index',$election))->with('success','Candidate Successfully Added');
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
    public function edit(Election $election,Candidate $candidate)
    {
        //
        $users = User::count();
        // dd($candidate->voter_id);
        // $voter_Id = Candidate::find($candidate->voter_id)->voterId;
        // $section = Section::find($candidate->section_id)->section;
        $imageUrl = $candidate->getMedia('candidate')->first()->getUrl();
        $image_detail = $candidate->getMedia('candidate')->first();

        $data = [
            'users' => $users,
            'candidate' => $candidate,
            'imageUrl' => $imageUrl,
            'election' => $election,
            // 'faculty' => $section,
        ];
        // dd($data[');
        return view('candidate/edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election ,Candidate $candidate)
    {
        //
        $candidate->delete();
        return redirect()->route('candidate.index',$election)->with('success','Candidate Succesfully Deleted');
    }
    public function uploadimage(Request $request)
    {
        // store image temporary
        if ($request->hasFile('candidate_image')) {

            $file = $request->file('candidate_image');
            $filename = $file->getClientOriginalName();
            $folder = uniqid().'-'.now()->timestamp;
            $file->storeAS('public/TemporaryImage/tmp/'. $folder,$filename);
            
            TemporaryImage::create([
                'folder' => $folder,
                'filename' => $filename
            ]);
            return $folder;
        }

        return '';

    }
    public function getImage()
    {

        $id = $_GET['load'];
        $cadidate_detail = Candidate::find($id);
        $image = $cadidate_detail->getMedia('candidate')->first();
        $imageUrl = $cadidate_detail->getMedia('candidate')->first()->getUrl();
        // dd($imageUrl);
        $file_name = array(
            'file_name' => $image->file_name
        );
        return response($file_name)->withHeaders([
            'Content-disposition' => 'attachment; filename=' . $image->file_name,
            'Access-Control-Expose-Headers' => 'Content-Disposition',
            'Content-Type' => $image->mimetype,
          ]);
    }
}
