<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'feature_video', 'level', 'category', 'fee', 'summary', 'feature_image'
    ];


    public function modules()
    {
    return $this->hasMany(Module::class, 'course_id', 'id');
    }
}
