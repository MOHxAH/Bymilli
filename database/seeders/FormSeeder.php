<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Form::create([
            'code'=>'SNA',
            'form_name'=>'start new job'
        ]);

        Form::create([
            'code'=>'WIR',
            'form_name'=>'work inspection request'
        ]);
    }
}
