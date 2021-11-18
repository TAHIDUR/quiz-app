<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'clas';



    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }
}
