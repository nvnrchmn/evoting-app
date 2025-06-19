<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }
    public function elections()
    {
        return $this->belongsToMany(Election::class, 'election_group');
    }
    // Group.php

}
