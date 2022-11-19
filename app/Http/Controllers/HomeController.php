<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function home(){

        // Hardcode for login Teacher = Teacher 1 --- Later we will implement proper login Auth;
        $teacher_id=1;

        // $sql=`SELECT qr_sections.course_id, qr_courses.name FROM qr_sections
        // LEFT JOIN qr_courses ON qr_courses.id=qr_sections.course_id
        // WHERE teacher_id=1`;
        //DB::select($sql);

        $courses=DB::table("qr_sections")
                ->select("qr_sections.course_id","qr_courses.name")
                ->leftjoin("qr_courses","qr_courses.id","=","qr_sections.course_id")
                ->where("qr_sections.teacher_id",$teacher_id)
                ->get()->toArray();

        return view('teacher-home')
               ->with("teacher_id",$teacher_id)
               ->with("courses_data",$courses);
    }

    public function section(){

        return view('teacher-section');
    }

    public function sectionList(){
        dd("I am here");
    }
}
