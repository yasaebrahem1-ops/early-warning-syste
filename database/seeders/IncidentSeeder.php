<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Incident;

class IncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Incident::create([
            'title' => 'حادث سير #EMG-8091',
            'type' => 'تصادم مركبات',
            'location' => 'شارع النصر، مدينة نصر',
            'status' => 'active',
            'lat' => 30.0550,
            'lng' => 31.2800,
        ]);

        Incident::create([
            'title' => 'طوارئ طبية حادة #EMG-8090',
            'type' => 'حالة إغماء أو أزمة قلبية',
            'location' => 'طريق السويس - الكيلو 21',
            'status' => 'active',
            'lat' => 30.0600,
            'lng' => 31.3000,
        ]);
    }
}