<?php
namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil election pertama
        $election = Election::first();

        // Jika belum ada election, kita buat dummy satu
        if (! $election) {
            $election = Election::create([
                'title'       => 'Pemilihan Ketua dan Wakil 2025',
                'description' => 'Pemilihan secara elektronik untuk menentukan ketua dan wakil periode 2025',
                'status'      => 'open',
            ]);
        }

        // Buat 5 pasangan kandidat
        for ($i = 1; $i <= 5; $i++) {
            $candidate = Candidate::create([
                'election_id' => $election->id,
                'vision'      => "Visi Pasangan $i",
                'mission'     => "Misi Pasangan $i",
                'photo'       => null, // bisa diisi dengan dummy file path jika perlu
            ]);

            // Ketua
            $candidate->persons()->create([
                'name'     => "Ketua $i",
                'position' => 'ketua',
                'photo'    => null,
            ]);

            // Wakil
            $candidate->persons()->create([
                'name'     => "Wakil $i",
                'position' => 'wakil',
                'photo'    => null,
            ]);
        }
    }
}
