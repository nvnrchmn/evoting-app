<?php
namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $elections = Election::all();

        $selectedElection = $request->election_id
        ? Election::find($request->election_id)
        : Election::where('status', 'open')->latest()->first();

        if (! $selectedElection) {
            return view('dashboard', [
                'elections'        => $elections,
                'selectedElection' => null,
                'labels'           => [],
                'data'             => [],
                'summary'          => [],
            ]);
        }

        $candidates    = $selectedElection->candidates()->with('persons')->get();
        $totalEligible = $selectedElection->users()->count();
        $labels        = $data        = $summary        = [];

        foreach ($candidates as $candidate) {
            $name       = $candidate->persons->pluck('name')->implode(' & ');
            $votes      = $candidate->votes()->count();
            $percentage = $totalEligible > 0 ? round(($votes / $totalEligible) * 100, 2) : 0;

            $labels[]  = $name;
            $data[]    = $percentage;
            $summary[] = [
                'name'       => $name,
                'voteCount'  => $votes,
                'percentage' => $percentage,
            ];
        }

        return view('dashboard', compact(
            'elections',
            'selectedElection',
            'labels',
            'data',
            'summary'
        ));
    }
}
