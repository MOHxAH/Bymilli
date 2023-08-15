<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Question::create([
            'content'=>'work_major',
        ]);
        Question::create([
            'content'=>'stage',
        ]);
        Question::create([
            'content'=>'region',
        ]);
        Question::create([
            'content'=>'building',
        ]);
        Question::create([
            'content'=>'role',
        ]);
        Question::create([
            'content'=>'attachment_type',
        ]);
        Question::create([
            'content'=>'attachment_file',
        ]);
        Question::create([
            'content'=>'tasks',
        ]);
        Question::create([
            'content'=>'location_d',
        ]);
        Question::create([
            'content'=>'elevation',
        ]);
        Question::create([
            'content'=>'start_job_date',
        ]);
        Question::create([
            'content'=>'end_job_date',
        ]);
        Question::create([
            'content'=>'contractor_major',
        ]);
        Question::create([
            'content'=>'contractor_name',
        ]);
        Question::create([
            'content'=>'contractor_sign_date',
        ]);
        Question::create([
            'content'=>'contractor_signature',
        ]);
        Question::create([
            'content'=>'project_manager_contractor_name',
        ]);
        Question::create([
            'content'=>'project_manager_contractor_sign_date',
        ]);
        Question::create([
            'content'=>'project_manager_contractor_signature',
        ]);

        //id 20
        Question::create([
            'content'=>'consultant_major',
        ]);

        Question::create([
            'content'=>'consultant_name',
        ]);
        Question::create([
            'content'=>'consultant_signature',
        ]);
        Question::create([
            'content'=>'consultant_notes',
        ]);
        Question::create([
            'content'=>'project_manager_consultant_name',
        ]);
        Question::create([
            'content'=>'project_manager_consultant_sign_date',
        ]);
        Question::create([
            'content'=>'project_manager_consultant_signature',
        ]);
        Question::create([
            'content'=>'owner_approval_name',
        ]);
        Question::create([
            'content'=>'owner_approval_job',
        ]);
        Question::create([
            'content'=>'owner_approval_sign_date',
        ]);
        Question::create([
            'content'=>'owner_approval_signature',
        ]);
    }
}

