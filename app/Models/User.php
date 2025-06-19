<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'has_voted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }
    public function elections()
    {
        return Election::whereHas('groups', function ($query) {
            $query->whereIn('groups.id', $this->groups->pluck('id'));
        })->get();
    }

    public function hasVotedInElection($electionId)
    {
        return $this->votes()->where('election_id', $electionId)->exists();
    }

}
