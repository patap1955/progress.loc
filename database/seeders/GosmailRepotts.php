<?php

namespace Database\Seeders;

use App\Models\Gospochta\GosmailReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GosmailRepotts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doc1 = new GosmailReport();
        $doc1->name = "Форма1";
        $doc1->active = 0;
        $doc1->save();

        $doc1 = new GosmailReport();
        $doc1->name = "Форма2";
        $doc1->active = 1;
        $doc1->save();

        $doc1 = new GosmailReport();
        $doc1->name = "Форма3";
        $doc1->active = 1;
        $doc1->save();

        $doc1 = new GosmailReport();
        $doc1->name = "Форма4";
        $doc1->active = 1;
        $doc1->save();
    }
}
