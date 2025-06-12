<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['election_id', 'vision', 'mission', 'photo'];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function persons()
    {
        return $this->hasMany(Person::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
