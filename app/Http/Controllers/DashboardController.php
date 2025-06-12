<?php
namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): Factory | View
    {
        $totalVotes = Vote::count();
        $candidates = Candidate::with('persons')->get();

        $labels  = [];
        $data    = [];
        $summary = [];

        foreach ($candidates as $candidate) {
            $name       = $candidate->persons->pluck('name')->implode(' & ');
            $count      = Vote::where('candidate_id', $candidate->id)->count();
            $percentage = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 2) : 0;

            $labels[] = $name;
            $data[]   = $percentage;

            // Untuk tampilan awal
            $summary[] = [
                'name'       => $name,
                'votes'      => $count,
                'percentage' => $percentage,
            ];
        }

        return view('dashboard', compact('labels', 'data', 'summary'));
    }
}
