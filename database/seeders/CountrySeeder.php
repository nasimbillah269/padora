<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Seed the `countries` table (country / division / district / thana geo
     * data) with an exact copy of the project's current local data.
     * Source: database/seeders/data/countries.json (856 rows).
     */
    public function run(): void
    {
        $path = database_path('seeders/data/countries.json');

        if (!file_exists($path)) {
            $this->command?->warn('countries.json seed file not found, skipping.');
            return;
        }

        $rows = json_decode(file_get_contents($path), true) ?: [];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('countries')->upsert(
                $chunk,
                ['id'],
                ['name', 'bn_name', 'image', 'nationality', 'type', 'parent_id', 'created_at', 'updated_at']
            );
        }

        $this->command?->info(count($rows).' countries rows seeded.');
    }
}
