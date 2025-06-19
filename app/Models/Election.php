<?php
namespace App\Models;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'election_group');
    }
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

}
