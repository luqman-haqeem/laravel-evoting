<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voter extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 'matric_number', 'faculties_id','election_id'
    ];
    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculties_id');
    }


}
