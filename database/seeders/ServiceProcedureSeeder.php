<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ServiceProcedureSeeder extends Seeder
{
    public function run(): void
    {
        $procedures = [

            'Consultation' => [
                ['Consultation', 500, null, null],
            ],

            'Oral Prophylaxis' => [
                ['Mild to Moderate Gingivitis', 1500, null, 'Minimum price.'],
                ['Severe Gingivitis with/without Stains', 2500, null, 'Minimum price.'],
                ['Fluoride Varnish Treatment', 1000, null, null],
                ['Fluoride Gel Treatment', 500, null, null],
            ],

            'Periodontal Treatment' => [
                ['Non-Surgical Root Planning', 2000, 'per tooth', null],
                ['Non-Surgical Root Planning', 5000, 'per quadrant', null],
                ['Surgical Root Planning', 5000, 'per tooth', null],
                ['Surgical Root Planning', 10000, 'per quadrant', null],
            ],

            'Pediatric Treatment' => [
                ['Stainless Steel Crowns', 3000, 'per unit', 'Minimum price.'],
                ['Strip Off Crowns', 3500, 'per unit', 'Minimum price.'],
                ['Pulpotomy', 5000, null, 'Minimum price.'],
                ['Pulpectomy', 5000, null, 'Minimum price.'],
                ['Silver Diamine Fluoride', 1500, 'per surface', 'Minimum price.'],
                ['Space Maintainer', 5000, null, 'Minimum price.'],
                ['Preventive Orthodontic Appliance', 10000, null, 'Minimum price.'],
            ],

            'Restoration' => [
                ['Direct Filling', 1500, 'per surface', 'Minimum price.'],
                ['Indirect Restoration', 5000, null, 'Minimum price.'],
                ['Temporary Restoration', 1500, null, 'Minimum price.'],
                ['Pits Fissure Sealant', 1500, 'per tooth', null],
                ['Liner & Base Medication', 500, null, 'Minimum price.'],
            ],

            'Veneers' => [
                ['Direct Composite Veneers', 6500, 'per tooth', 'Minimum price.'],
                ['Indirect Composite Veneers', 15000, 'per tooth', 'Minimum price.'],
                ['Indirect Zirconia/Emax Veneers', 25000, 'per tooth', null],
            ],

            'Crowns and Bridges' => [
                ['Acrylic Crowns', 6000, 'per unit', 'Minimum price.'],
                ['Acrylic with Metal Backing', 6500, 'per unit', 'Minimum price.'],
                ['Porcelain Fused to Metal Crowns', 9500, 'per unit', 'Minimum price.'],
                ['Ceramage', 15000, 'per unit', 'Minimum price.'],
                ['All Porcelain (E-max)', 25000, 'per unit', null],
                ['Zirconia', 25000, 'per unit', null],
                ['Recementation', 1000, 'per unit', 'Minimum price.'],
                ['Removal of Old Crowns', 1500, 'per unit', null],
            ],

            'Dental Whitening' => [
                ['In-Office Whitening', 15000, null, 'Minimum price.'],
                ['Additional Session', 5000, 'per session', 'Minimum price.'],
            ],

            'Root Canal Treatment' => [
                ['Vital Tooth/Simple Case', 7500, 'per canal', null],
                ['Non-Vital Tooth/Difficult Case', 8500, 'per canal', 'Minimum price.'],
                ['Re-treatment', 10000, 'per canal', null],
                ['Extension of Treatment', 2000, 'per session', null],
                ['Fiber or Metal Post and Core', 5000, null, 'Minimum price.'],
                ['Apicoectomy', 10000, null, 'Minimum price.'],
            ],

            'Surgical Treatment' => [
                ['Temporary Tooth Extraction', 1500, null, 'Minimum price.'],
                ['Permanent Tooth Extraction', 1500, null, 'Minimum price.'],
                ['Erupted 3rd Molars', 2500, null, 'Minimum price.'],
                ['Suture Placement', 1000, null, null],
                ['Complicated Extraction (Splitting of Tooth)', 3500, null, 'Minimum price.'],
                ['Open Flap Extraction/Extraction with Alveoloplasty', 5000, null, 'Minimum price.'],
                ['Impacted Tooth', 10000, null, 'Minimum price.'],
                ['Frenectomy', 10000, null, 'Minimum price.'],
                ['Alveoloplasty', 5000, 'per quadrant', null],
                ['Gingivectomy with Crown Lengthening', 15000, 'per arch', null],
                ['Incision and Drainage', 5000, null, null],
                ['Incision/Excision of Lesion', 5000, null, null],
                ['Biopsy Procedure', 8000, null, null],
                ['Removal of Torus', 10000, null, 'Minimum price.'],
                ['Change Dressing/Debridement', 500, null, 'Minimum price.'],
                ['Implants (excluding the crown)', 50000, 'per implant', null],
                ['Bone Graft', 15000, 'per cc', null],
                ['Surgical Tooth Exposure and Orthodontic Bonding', 8000, null, 'Minimum price.'],
            ],

            'Implant Supported Restorations' => [
                ['PFM for Implant', 10000, null, null],
                ['Zirconia for Implant', 30000, null, null],
                ['Implant Retained Dentures', 40000, null, 'Minimum price.'],
            ],

            'TMD Therapy' => [
                ['TMD Assessment & Diagnosis', 1500, null, null],
                ['TMD Therapy', 65000, null, 'Minimum price.'],
                ['Extension of Treatment', 2500, 'per session', 'Minimum price.'],
                ['Occlusal Splint Therapy', 10000, null, 'Minimum price.'],
                ['Bruxism Night Guards', 10000, null, 'Minimum price.'],
            ],

            'Orthodontics' => [
                ['Conventional', 70000, null, 'Minimum price.'],
                ['Self-Ligating', 100000, null, 'Minimum price.'],
                ['Ceramic Brackets', 90000, null, 'Minimum price.'],
                ['Trainers', 30000, null, null],
                ['Orthodontic Splint', 10000, null, 'Minimum price.'],
                ['Recementation of Brackets', 1000, 'per bracket', null],
                ['Extension of Treatment', 1500, 'per adjustment', 'Minimum price.'],
                ['Broken Wire', 500, null, null],
                ['Replacement of Brackets - Conventional', 1000, null, null],
                ['Replacement of Brackets - Self-Ligating', 2000, null, null],
                ['Replacement of Brackets - Ceramics', 2000, null, null],
                ['Temporary Anchorage Device (TADS)', 15000, 'each', null],
                ['Removal of Braces with Prophylaxis & Fluoride Treatment', 6500, null, 'Minimum price.'],
                ['Athletic Mouth Guard', 10000, null, null],
            ],

            'Retainers' => [
                ['Hawley', 7500, 'per arch', 'Minimum price.'],
                ['Fixed Lingual Retainers', 10000, 'per arch', null],
                ['Invisible Retainers', 10000, 'per arch', 'Minimum price.'],
            ],
        ];

        DB::transaction(function () use ($procedures) {
            foreach ($procedures as $categoryName => $items) {
                $categoryId = DB::table('service_categories')
                    ->where('category_name', $categoryName)
                    ->value('id');

                if (!$categoryId) {
                    throw new RuntimeException(
                        "Service category not found: {$categoryName}. Run the category seeder first."
                    );
                }

                foreach ($items as [$name, $price, $unit, $description]) {
                    $exists = DB::table('service_procedures')
                        ->where('category_id', $categoryId)
                        ->where('procedure_name', $name)
                        ->where('pricing_unit', $unit)
                        ->exists();

                    if ($exists) {
                        continue;
                    }

                    DB::table('service_procedures')->insert([
                        'category_id' => $categoryId,
                        'procedure_name' => $name,
                        'price' => $price,
                        'pricing_unit' => $unit,
                        'duration_minutes' => null,
                        'description' => $description,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    }
}
