<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Birth Certificate',
                'slug' => 'birth_certificate',
                'description' => 'Official record of birth registration.',
                'required_fields' => ['child_name', 'date_of_birth', 'father_name', 'mother_name'],
            ],
            [
                'name' => 'Death Certificate',
                'slug' => 'death_certificate',
                'description' => 'Official record confirming death.',
                'required_fields' => ['deceased_name', 'date_of_death', 'relation_to_applicant'],
            ],
            [
                'name' => 'Marriage Certificate',
                'slug' => 'marriage_certificate',
                'description' => 'Official record of marriage registration.',
                'required_fields' => ['spouse1_name', 'spouse2_name', 'date_of_marriage'],
            ],
            [
                'name' => 'Citizenship Recommendation',
                'slug' => 'citizenship_recommendation',
                'description' => 'Ward recommendation letter for citizenship application.',
                'required_fields' => ['applicant_name', 'date_of_birth', 'father_name', 'permanent_address'],
            ],
        ];

        foreach ($types as $type) {
            DocumentType::updateOrCreate(['slug' => $type['slug']], $type);
        }
    }
}


