<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Consultation' => ['legacy' => true, 'description' => 'Dental consultation and assessment.'],
            'Endodontics' => ['legacy' => true, 'description' => 'Root canal and treatment of the inner parts of teeth.'],
            'Oral Surgery' => ['legacy' => true, 'description' => 'Tooth extractions and oral surgical procedures.'],
            'Orthodontics' => ['legacy' => true, 'description' => 'Braces and bite correction treatments.'],
            'Prosthodontics' => ['legacy' => true, 'description' => 'Crowns, bridges, dentures and implants.'],
            'Esthetics' => ['legacy' => true, 'description' => 'Whitening, veneers, bonding and aesthetic treatments.'],

            'Oral Prophylaxis' => ['legacy' => false, 'description' => 'Professional dental cleaning and preventive treatments.'],
            'Periodontal Treatment' => ['legacy' => false, 'description' => 'Treatment of gum and periodontal conditions.'],
            'Pediatric Treatment' => ['legacy' => false, 'description' => 'Dental treatments for children.'],
            'Restoration' => ['legacy' => false, 'description' => 'Restorative procedures for damaged teeth.'],
            'Veneers' => ['legacy' => false, 'description' => 'Direct and indirect dental veneer treatments.'],
            'Crowns and Bridges' => ['legacy' => false, 'description' => 'Dental crowns, bridges and recementation.'],
            'Dental Whitening' => ['legacy' => false, 'description' => 'In-office whitening and additional sessions.'],
            'Root Canal Treatment' => ['legacy' => false, 'description' => 'Root canal procedures and related treatments.'],
            'Surgical Treatment' => ['legacy' => false, 'description' => 'Oral surgical and related procedures.'],
            'Implant Supported Restorations' => ['legacy' => false, 'description' => 'Restorations supported by dental implants.'],
            'TMD Therapy' => ['legacy' => false, 'description' => 'Temporomandibular disorder assessment and therapy.'],
            'Retainers' => ['legacy' => false, 'description' => 'Removable and fixed orthodontic retainers.'],
        ];

        foreach ($categories as $name => $details) {
            // Preserve existing category records and administrator edits.
            $exists = DB::table('service_categories')
                ->where('category_name', $name)
                ->exists();

            if ($exists) {
                continue;
            }

            $legacyId = null;

            if ($details['legacy']) {
                $legacyId = DB::table('services')
                    ->where('service_name', $name)
                    ->value('id');

                if (!$legacyId) {
                    throw new RuntimeException(
                        "Existing service not found: {$name}"
                    );
                }
            }

            DB::table('service_categories')->insert([
                'category_name' => $name,
                'legacy_service_id' => $legacyId,
                'description' => $details['description'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
