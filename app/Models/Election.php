<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status'];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }
    // public function group()
    // {
    //     return $this->belongsToMany(Group::class);
    // }

    // public function groups()
    // {
    //     return $this->belongsToMany(\App\Models\Group::class, 'election_group');
    // }
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

// Ambil users dari semua grup yg terdaftar
    public function users()
    {
        return $this->groups->flatMap->users->unique('id');
    }

}
