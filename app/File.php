<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class File extends Model
{
    protected $fillable = ['name', 'key', 'size', 'type', 'url', 'disk'];

    public function models()
    {
        return DB::table('fileables')->where('file_id', $this->id);
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'fileable');
    }

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'fileable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'fileable');
    }
}
