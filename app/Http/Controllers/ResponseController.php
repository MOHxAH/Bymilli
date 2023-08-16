<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Response;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ResponseController extends Controller
{
    public function createResponse(Request $request, $version_id)
    {

            $questionData = [
                'questions' => []
            ];

            foreach ($request->all() as $key => $question) {
                if (in_array($key, ['41', '45', '49','52','56','60'])) {
                    $object = [
                        'form_question_id' => $key,
                        'files' => $question
                    ];
                } else {
                    $object = [
                        'form_question_id' => $key,
                        'content' => $question
                    ];
                }

                $questionData["questions"][] = $object;
            }

            // Validation rules for the input data
            // $validation = Validator::make($questionData, [
            //     'questions' => 'required|array',
            //     'questions.*.form_question_id' => 'required|integer',
            //     'questions.*.content' => 'exclude_if:questions.*.form_question_id,41,45,49,52,56,60|required|string',
            //     'questions.*.files' => 'exclude_unless:questions.*.form_question_id,41,45,49,52,56,60|required|file',

            // ]);
            // If validation fails, return a response with validation errors
            // if ($validation->fails()) {
            //     return response()->json(['message' => 'Validation failed', 'errors' => $validation->errors()], 422);
            // }

            // Start a database transaction
            DB::beginTransaction();
            try {

            // Check if a response already exists for the given version
            if (Response::where('version_id', $version_id)->count() > 0) {
                // Roll back the transaction and return a response indicating the error
                DB::rollback();
                return response()->json(['error' => 'A response already exists'], 400);
            }

            $version = Version::where()->latest()->first();
            // Create a new response
            $newResponse = Response::create([
                'version_id' => $version_id,
                'rate' => $request->rate,
            ]);

            // Create answers for each question in the input
            foreach ($questionData['questions'] as $question) {
                if(in_array($question["form_question_id"], ['41', '45', '49','52','56','60'])){
                    $file = $question["files"];
                    $filename = date('YmdHi').$file->getClientOriginalName();
                    $file->move(public_path('images'), $filename);
                    $question['content']= $filename;
                }
                $newAnswer = Answer::create([
                    'version_id' => $version_id,
                    'form_question_id' => $question['form_question_id'],
                    'user_id' => auth()->id(),
                    'content' => $question['content'],
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Return a success response
            return response()->json(['message' => 'Response created successfully.',
            'user_type '=>auth()->user()->user_type], 201);
        } catch (\Exception $e) {
            // If an exception occurs, roll back the transaction and return an error response
            DB::rollback();
            return response()->json(['error' => 'An error occurred while processing your request'.$e->getMessage()], 500);
        }
    }


    }
