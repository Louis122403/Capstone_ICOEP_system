<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            // Specialized Venues & Laboratories
            [
                'name' => 'College Library',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 80,
                'description' => 'Tertiary research library providing quiet study stations, academic references, and scholarly resources for college students and faculty.',
                'status' => 'available',
            ],
            [
                'name' => 'High School Library',
                'location' => 'Holy Family Campus, Ground Floor (St. Francis de Sales Library)',
                'capacity' => 60,
                'description' => 'Basic education library offering textbooks, learning modules, reference materials, and quiet reading areas for high school learners.',
                'status' => 'available',
            ],
            [
                'name' => 'Louisean Square (Safe Zone / Quadrangle)',
                'location' => 'Holy Family Campus, Central Grounds',
                'capacity' => 600,
                'description' => 'Central open-air campus grounds and quadrangle for institutional gatherings, flag ceremonies, school fairs, and outdoor student activities.',
                'status' => 'available',
            ],
            [
                'name' => 'Computer Laboratory (Com Lab)',
                'location' => 'Miraculous Medal Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Air-conditioned computer laboratory with desktop workstations and internet connectivity for IT classes, practical exams, and digital literacy training.',
                'status' => 'available',
            ],
            [
                'name' => 'Science Laboratory (Sci Lab)',
                'location' => 'Miraculous Medal Building, 2nd Floor',
                'capacity' => 40,
                'description' => 'Fully-equipped laboratory with workbenches, gas/water fixtures, and safety equipment for chemistry, biology, and general science experiments.',
                'status' => 'available',
            ],
            [
                'name' => 'Industrial Arts Building / TLE Laboratory',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 35,
                'description' => 'Dedicated workshop and laboratory for Technical-Vocational-Livelihood (TVL), Technology and Livelihood Education (TLE), and hands-on skills training.',
                'status' => 'available',
            ],
            [
                'name' => 'Covered Court',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 500,
                'description' => 'Spacious outdoor covered court for institutional assemblies, athletic events, PE classes, and campus gatherings.',
                'status' => 'available',
            ],
            [
                'name' => 'AVR (Audio-Visual Room)',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 60,
                'description' => 'Audio-visual facility equipped with projector, sound system, and tiered seating for presentations, defenses, film showings, and seminars.',
                'status' => 'available',
            ],

            // General Classrooms (In Numerical Order)
            [
                'name' => 'Room 2',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 45,
                'description' => 'Ground-floor instructional classroom equipped with student chairs, whiteboard, and teacher desk for lectures and meetings.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 3',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 45,
                'description' => 'Ground-floor instructional classroom equipped with student chairs, whiteboard, and teacher desk for lectures and meetings.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 4',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 45,
                'description' => 'Ground-floor instructional classroom equipped with student chairs, whiteboard, and teacher desk for lectures and meetings.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 13',
                'location' => 'St. Vincent De Paul Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Second-floor instructional classroom for academic lectures, departmental meetings, and student group sessions.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 14',
                'location' => 'St. Vincent De Paul Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Second-floor instructional classroom for academic lectures, departmental meetings, and student group sessions.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 15',
                'location' => 'St. Vincent De Paul Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Second-floor instructional classroom for academic lectures, departmental meetings, and student group sessions.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 16',
                'location' => 'St. Vincent De Paul Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Second-floor instructional classroom for academic lectures, departmental meetings, and student group sessions.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 17',
                'location' => 'St. Vincent De Paul Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Second-floor instructional classroom for academic lectures, departmental meetings, and student group sessions.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 18',
                'location' => 'St. Vincent De Paul Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Second-floor instructional classroom for academic lectures, departmental meetings, and student group sessions.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 19',
                'location' => 'St. Vincent De Paul Building, 2nd Floor',
                'capacity' => 45,
                'description' => 'Second-floor instructional classroom for academic lectures, departmental meetings, and student group sessions.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 27',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 45,
                'description' => 'Ground-floor instructional classroom equipped with student chairs, whiteboard, and teacher desk for lectures and meetings.',
                'status' => 'available',
            ],
            [
                'name' => 'Room 28',
                'location' => 'Holy Family Campus, Ground Floor',
                'capacity' => 45,
                'description' => 'Ground-floor instructional classroom equipped with student chairs, whiteboard, and teacher desk for lectures and meetings.',
                'status' => 'available',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::updateOrCreate(
                ['name' => $facility['name']],
                $facility
            );
        }
    }
}
