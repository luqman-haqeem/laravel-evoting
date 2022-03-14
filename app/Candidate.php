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

    public function voterId()
    {
        return $this->belongsTo(Voter::class,'voter_id');
    }
}

