<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaxVote extends Model
{
    use HasFactory;
    protected $fillable = ['election_id', 'sections_id', 'max_votes'];


    public function section()
    {
        return $this->belongsTo(Section::class,'sections_id');
    }
}
