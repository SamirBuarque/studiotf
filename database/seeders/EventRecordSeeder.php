<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventRecord;

class EventRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventRecord::factory()->create([
            "name" => "Arraia da vila",
            "city" => "sao miguel dos milagres",
            "state" => "alagoas",
            "date" => Carbon::create(2025, 06, 16),
            "status" => "Produção Local"
        ]);
        EventRecord::factory()->create([
            "name" => "Semana santa",
            "city" => "porto real do colegio",
            "state" => "alagoas",
            "date" => Carbon::create(2025, 03, 17),
            "status" => "Entregue"
        ]);
        EventRecord::factory()->create([
            "name" => "Carnaval de atalaia",
            "city" => "Atalaia",
            "state" => "alagoas",
            "date" => Carbon::create(2026, 01, 15),
            "status" => "Planejamento"
        ]);
        EventRecord::factory()->create([
            "name" => "Festival de inverno",
            "city" => "mar vermelho",
            "state" => "alagoas",
            "date" => Carbon::create(2026, 02, 21),
            "status" => "Planejamento"
        ]);
        EventRecord::factory()->create([
            "name" => "Reveilon",
            "city" => "matriz de camaragibe",
            "state" => "alagoas",
            "date" => Carbon::create(2025, 12, 24),
            "status" => "Produção Fábrica"
        ]);
    }
}
