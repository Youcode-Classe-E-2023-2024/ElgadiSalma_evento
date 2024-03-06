<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villes = [
            'Casablanca',
            'Rabat',
            'Marrakech',
            'Fès',
            'Tanger',
            'Agadir',
            'Meknès',
            'Oujda',
            'Kenitra',
            'Tétouan',
            'Salé',
            'Nador',
            'Beni Mellal',
            'Safi',
            'Mohammédia',
        ];
        

        foreach ($villes as $ville) {
            DB::table('lieu')->insert([
                'ville' => $ville,
            ]);
        }
    }
}
