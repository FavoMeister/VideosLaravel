<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'purchase_price',
        'video_path',
        'status',
    ];

    public $timestamps = true;

    /*
     * Relationships
    */

    // One to Many
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // One to Many (Inverse)
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commentsOrdered()
    {
        return $this->comments()->orderBy('id', 'desc');
    }
}
