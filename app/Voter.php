<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voter extends Model
{
    use HasFactory,SoftDeletes;
    
    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculties_id');
    }

    public static function  notCandidatefor($election)
    {
        $voter = Voter::whereNotIn('id',function($query){
            $query->selectRaw('voter_id')->where('election_id','=','$election')->from('candidates');
        } )->get();
        return $voter;
    }
}
