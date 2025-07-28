<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    use HasFactory;

    protected $fillable = ['title', 'feature_video', 'level', 'category_id', 'price', 'summary', 'feature_image'];

    public function modules() {return $this->hasMany( Module::class );}
}