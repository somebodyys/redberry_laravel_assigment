<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Initial' => 'Initial Status Description',
            'First Contact' => 'First Contact status Description',
            'Interview' => 'Interview status Description',
            'Tech Assigment' => 'Tech assigment status Description',
            'Rejected' => 'Rejected status Description',
            'Hired' => 'Hired status Description'
        ];

        foreach ($statuses as $name => $description) {
            Status::create([
                'name' => $name,
                'description' => $description
            ]);
        }
    }
}
