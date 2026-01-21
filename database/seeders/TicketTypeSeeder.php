<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Reguler', 'VIP', 'Early Bird'];

        foreach ($types as $type) {
            TicketType::create(['nama' => $type]);
        }
    }
}
