<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StorySeeker;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    //Relationship start

    /*
     * A Comment belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
     * A Comment belong to a story
     */
    public function story_seeker()
    {
        return $this->belongsTo(StorySeeker::class, 'story_seeker_id');
    }
}
