<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SchoolSeeker;
use App\Models\StoryTeller;
use App\Models\Feedback;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password', 'mobile_no', 'gender', 'date_of_birth', 'location', 'profile_image', 'writing_preference', 'is_admin', 'is_approved', 'is_verified', 'is_activated', 'is_story_seeker', 'is_story_teller', 'story_seeker_id', 'code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function story_seeker()
    {
        return $this->belongsTo(StorySeeker::class, 'story_seeker_id');
    }

    public function story_teller()
    {
        return $this->belongsTo(StoryTeller::class, 'story_teller_id');
    }

    /*
     * A User has  many feedbacks
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
