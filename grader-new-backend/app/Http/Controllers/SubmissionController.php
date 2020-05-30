<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

require 'backend-compilador/upload.php';

use App\submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return submission::all();
    }

    public static function uploadSubmission($id,$grade,$user_id)
    {
        $try = DB::table('alumno_submission_intento')->where([
            ['assignment_id', '=',$id],
            ['id', '=',$user_id],
        ])->value('tries_left');
        
        if($try > 0){
            DB::table('submissions')->insert([
                'assignment_id' => $id,
                'grade' => $grade,
                'user_id' => $user_id,
            ]);
            return  json_encode([$grade]);
        }
        else{
            return json_encode(["Maximum number of tries used"]);
        }
    }

    public static function getLanguage($id)
    {
        return DB::table('languages')->where([
            ['language_id', '=',$id]
        ])->value('language');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return compile();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('alumno_submission_intento')->where([
            ['id', '=',$id]
        ])->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
