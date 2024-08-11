<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of tasks you want to insert
        $numberOfTasks = 10;

        for ($i = 0; $i < $numberOfTasks; $i++) {
            DB::table('tasks')->insert([
                'user_id' => rand(1, 10), // Example user ID
                'title' => 'Task ' . ($i + 1),
                'description' => 'This is a description for task ' . ($i + 1),
                'completed' => (bool) rand(0, 1), // Randomly set completed status
                'duedate' => now()->addDays(rand(1, 30)), // Random due date within the next 30 days
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
