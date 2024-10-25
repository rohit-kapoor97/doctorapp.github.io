<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class BookApp extends Model
{

    protected $fillable=['pname','phone', 'pdepart', 'pemail', 'slug', 'pdes'];
    use HasFactory, Sluggable;

    public function Sluggable():array{
        return['slug'=> [
            'source'=>'pname'
        ]];
    }
}
