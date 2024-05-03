<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doc1 = new Region();
        $doc1->name = "Нет региона";
        $doc1->save();

        $doc2 = new Region();
        $doc2->name = "Республика Башкортостан";
        $doc2->save();

        $doc3 = new Region();
        $doc3->name = "Республика Бурятия";
        $doc3->save();

        $doc4 = new Region();
        $doc4->name = "Республика Алтай";
        $doc4->save();

        $doc5 = new Region();
        $doc5->name = "Республика Дагестан";
        $doc5->save();

        $doc6 = new Region();
        $doc6->name = "Республика Ингушетия";
        $doc6->save();
    }
}
