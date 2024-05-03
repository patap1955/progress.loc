<?php

namespace Database\Seeders;

use App\Models\Fssp\Doc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doc1 = new Doc();
        $doc1->title = "Исполнительный лист";
        $doc1->save();

        $doc2 = new Doc();
        $doc2->title = "Нотариально удостоверенное соглашение об уплате алиментов";
        $doc2->save();

        $doc3 = new Doc();
        $doc3->title = "Акт по делу об административном правонарушении";
        $doc3->save();

        $doc4 = new Doc();
        $doc4->title = "";
        $doc4->save();

        $doc1 = new Doc();
        $doc1->title = "Судебный приказ";
        $doc1->save();

        $doc5 = new Doc();
        $doc5->title = "Акт органа, осуществляющего контрольные функции";
        $doc5->save();

        $doc6 = new Doc();
        $doc6->title = "Удостоверение комиссии по трудовым спорам";
        $doc6->save();

        $doc7 = new Doc();
        $doc7->title = "Акт другого органа";
        $doc7->save();

        $doc8 = new Doc();
        $doc8->title = "Постановление судебного пристава-исполнителя";
        $doc8->save();

        $doc9 = new Doc();
        $doc9->title = "Исполнительная надпись нотариуса";
        $doc9->save();

        $doc10 = new Doc();
        $doc10->title = "Судебный акт по делу об административном правонарушении";
        $doc10->save();

        $doc11 = new Doc();
        $doc11->title = "Запрос центрального органа о розыске ребенка";
        $doc11->save();

        $doc12 = new Doc();
        $doc12->title = "Исполнительный документ, выданный компетентным органом иностранного государства";
        $doc12->save();

        $doc13 = new Doc();
        $doc13->title = "Удостоверение, выданное уполномоченным по правам потребителей финансовых услуг в порядке, предусмотренном Федеральным законом от 04.06.2018 № 123-ФЗ Об уполномоченном по правам потребителей финансовых услуг";
        $doc13->save();

        $doc14 = new Doc();
        $doc14->title = "Опре-ие судьи о наложении ареста на им-во в целях обеспечения исполнения постановления о назначении адм-го наказания за совершение адм-го правонарушения, предусмотренного статьей 19.28 Кодекса Российской Федерации об адм-ных правонарушениях";
        $doc14->save();

        $doc15 = new Doc();
        $doc15->title = "Нотариально удостоверенное медиативное соглашение";
        $doc15->save();
    }
}
