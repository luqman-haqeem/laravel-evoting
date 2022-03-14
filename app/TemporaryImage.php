<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryImage extends Model
{
    use HasFactory;

    protected $fillable =['folder','filename'];
}
