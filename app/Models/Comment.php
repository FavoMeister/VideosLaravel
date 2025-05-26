<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'video_id',
        'body',
    ];
    
    protected $table = 'comments';

    public $timestamps = true;

    /*
     * Relationships
    */

    // One to Many (Inverse)
    public function video(){
        return $this->belongsTo(Video::class);
    }

    // One to Many (Inverse)
    public function user(){
        return $this->belongsTo(User::class);
    }

    
}