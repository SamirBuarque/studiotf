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
            "city" => "São Miguel dos Milagres",
            "state" => "Alagoas",
            "date" => Carbon::create(2025, 06, 16),
            "status" => "Produção Local"
        ]);
        EventRecord::factory()->create([
            "name" => "Semana santa",
            "city" => "Porto Real do Colégio",
            "state" => "Alagoas",
            "date" => Carbon::create(2025, 03, 17),
            "status" => "Entregue"
        ]);
        EventRecord::factory()->create([
            "name" => "Carnaval de atalaia",
            "city" => "Atalaia",
            "state" => "Alagoas",
            "date" => Carbon::create(2026, 01, 15),
            "status" => "Planejamento"
        ]);
        EventRecord::factory()->create([
            "name" => "Festival de inverno",
            "city" => "Mar Vermelho",
            "state" => "Alagoas",
            "date" => Carbon::create(2026, 02, 21),
            "status" => "Planejamento"
        ]);
        EventRecord::factory()->create([
            "name" => "Reveilon",
            "city" => "Matriz de Camaragibe",
            "state" => "Alagoas",
            "date" => Carbon::create(2025, 12, 24),
            "status" => "Produção Fábrica"
        ]);

        EventRecord::factory()->count(10)->create()
        ->each(function ($eventRecord) {
            $eventRecord->planning()->createMany([
                ['text' => 'planejamento 1 do evento '. $eventRecord->name],
                ['text' => 'planejamento 2 do evento '. $eventRecord->name],
                ['text' => 'planejamento 3 do evento '. $eventRecord->name]
            ]);
            $eventRecord->products()->createMany([
                ['name' => 'Produto 1 do evento '. $eventRecord->name, 
                'quantity' => 5],
                ['name' => 'Produto 2 do evento '. $eventRecord->name, 
                'quantity' => 12],
                ['name' => 'Produto 3 do evento '. $eventRecord->name, 
                'quantity' => 4],
            ]);
        });
    }
}
