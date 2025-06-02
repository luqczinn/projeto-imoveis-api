<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Property;
class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = Owner::all();

        foreach ($owners as $owner) {
            Property::factory()->count(2)->create([
                'owner_id' => $owner->id,
            ]);
        }
    }
}
