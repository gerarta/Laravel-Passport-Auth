<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $timestamp =  true;

    public function author(){
        return $this->belongsTo(Author::class);
    }
}
