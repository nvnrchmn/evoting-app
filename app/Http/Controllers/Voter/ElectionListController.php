<?php
namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ElectionListController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pastikan relasi elections() mengembalikan collection
        $elections = $user->elections();

        return view('voter.elections.index', compact('elections'));
    }
}
