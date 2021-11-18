<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Version;
use App\Models\Classes;

class Quiz extends Model
{
    use HasFactory;


    protected $guarded = [];

    public $timestamps = false;


    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }







    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }








    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
