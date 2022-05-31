<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Candidate extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,HasMediaTrait;
    protected $fillable = [
        'election_id', 'voter_id', 'section_id', 'motto',
    ];
    public function detail()
    {
        return $this->belongsTo(Voter::class,'voter_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}

