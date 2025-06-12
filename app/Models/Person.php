<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = ['candidate_id', 'name', 'position', 'photo'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
