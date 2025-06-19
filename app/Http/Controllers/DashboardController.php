<?php
namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = auth()->user();

        // Cek apakah user adalah admin
        if ($user->role === 'admin') {
            // Admin bisa melihat semua election
            $elections = Election::all();
        } else {
            $elections = Election::where('status', 'open')
                ->whereHas('groups.users', function ($query) {
                    $query->where('users.id', auth()->id());
                })
                ->get();
        }
        $selectedElection = $request->election_id
        ? $elections->firstWhere('id', $request->election_id)
        : $elections->first();

        if (! $selectedElection) {
            return view('dashboard', [
                'elections'        => $elections,
                'selectedElection' => null,
                'labels'           => [],
                'data'             => [],
                'summary'          => [],
            ]);
        }

        // Ambil kandidat beserta person-nya
        $candidates = $selectedElection->candidates()->with('persons')->get();

        // Ambil total user yang terkait election melalui group
        $totalEligible = $selectedElection->groups()
            ->with('users')
            ->get()
            ->flatMap->users
            ->unique('id')
            ->count();

        // Siapkan data grafik dan ringkasan
        $labels = $data = $summary = [];

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
