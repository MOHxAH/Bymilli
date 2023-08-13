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
        try {
            // Validation rules for the input data
            $rules = [
                'rate' => 'required|string|min:1|max:5',
                'questions' => 'required|array',
                'questions.*.form_question_id' => 'required|exists:form_questions,id',
                'questions.*.content' => 'required|string',
            ];

            // Validate the input data
            $validator = Validator::make($request->all(), $rules);

            // If validation fails, return a response with validation errors
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }

            // Start a database transaction
            DB::beginTransaction();

            // Check if a response already exists for the given version
            if (Response::where('version_id', $version_id)->count() > 0) {
                // Roll back the transaction and return a response indicating the error
                DB::rollback();
                return response()->json(['error' => 'A response already exists'], 400);
            }

            // Create a new response
            $newResponse = Response::create([
                'version_id' => $version_id,
                'rate' => $request->rate,
            ]);

            // Create answers for each question in the input
            foreach ($request->questions as $question) {
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
            return response()->json(['message' => 'Response created successfully.'], 201);
        } catch (\Exception $e) {
            // If an exception occurs, roll back the transaction and return an error response
            DB::rollback();
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }


    }
