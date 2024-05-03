<?php

namespace Database\Seeders;

use App\Models\Gospochta\Sender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sender1 = new Sender();
        $sender1->title = "Суд";
        $sender1->save();

        $sender2 = new Sender();
        $sender2->title = "Портал Госуслуг";
        $sender2->save();
    }
}
