<?php

namespace Database\Factories;

use App\Models\Studentinfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $student = Studentinfo::get();

        $record = [
            [
                'Filipino' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],
            [
                'English' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],  [
                'Mathematics' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],
            [
                'Science' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],
            [
                'Araling Panlipunan (AP)' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],
            [
                'Edukasyon sa Pagpapakatao (ESP)' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],
            [
                'Technology and Livelihood Education (TLE)' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],
            [
                'MAPEH' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => $this->faker->numberBetween(75, 99),
                    'remark' => 'PASSED'
                ]
            ],
            [
                'Music' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => '',
                    'remark' => ''
                ]
            ],
            [
                'Arts' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => '',
                    'remark' => ''
                ]
            ],
            [
                'Physical Education' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => '',
                    'remark' => ''
                ]
            ],
            [
                'Health' => [
                    'quarter_1' => $this->faker->numberBetween(75, 99),
                    'quarter_2' => $this->faker->numberBetween(75, 99),
                    'quarter_3' => $this->faker->numberBetween(75, 99),
                    'quarter_4' => $this->faker->numberBetween(75, 99),
                    'final' => '',
                    'remark' => ''
                ]
            ]
        ];

        return [
            'lrn' =>  $student[$this->faker->numberBetween(0, count($student))]->lrn,
            'sex' => $this->faker->numberBetween(0, 1),
            'school' => $this->faker->address() . ' School',
            'school_id' => $this->faker->numberBetween(1111, 9999),
            'district' => $this->faker->numberBetween(1, 20),
            'division' => $this->faker->numberBetween(1, 10),
            'region' => $this->faker->numberBetween(1, 10),
            'classified_grade' => $this->faker->numberBetween(7, 10),
            'section' => $this->faker->realText(10),
            'section_id' => $this->faker->numberBetween(1111, 9999),
            'school_year' => '2023-2024',
            'adviser' => $this->faker->name(),
            'data' => $record,
            'remedials' => [],
            'gen_ave' => $this->faker->numberBetween(75, 99),
            'default' => 1
        ];
    }
}
