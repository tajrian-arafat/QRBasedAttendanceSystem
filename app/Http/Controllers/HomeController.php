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
                ->distinct("qr_courses.id")
                ->get()->toArray();

        return view('teacher-home')
               ->with("teacher_id",$teacher_id)
               ->with("courses_data",$courses);
    }

    public function section(){

        $section_id=isset($_POST["sid"])?$_POST["sid"]:0;
        $section_id=isset($_GET["sid"])?$_GET["sid"]:$sid;

        $course_id=isset($_POST["cid"])?$_POST["cid"]:0;
        $course_id=isset($_GET["cid"])?$_GET["cid"]:$cid;

        $details=DB::table("qr_sections")
                ->select("qr_sections.*","qr_courses.name")
                ->leftjoin("qr_courses","qr_courses.id","=","qr_sections.course_id")
                ->where("qr_sections.id",$section_id)
                ->where("qr_sections.course_id",$course_id)
                ->get()->toArray();
        $raw="section_ids LIKE '%".$section_id."%'";
        $students=DB::table("qr_students")
                ->select("qr_students.*")
                ->whereRaw($raw)
                ->get()->toArray();

        foreach($students as $k=>$student){
            $students[$k]->attendance_records=DB::table("qr_attendance_data")
                                ->where("student_id",$student->id)
                                ->where("section_id",$section_id)
                                ->orderby("date","desc")
                                ->get()->toArray();
        }

        return view('teacher-section')
                ->with("details",$details)
               ->with("students",$students);
    }

    public function sectionList(){

        $teacher_id=isset($_POST["teacher_id"])?$_POST["teacher_id"]:0;
        $teacher_id=isset($_GET["teacher_id"])?$_GET["teacher_id"]:$teacher_id;

        $course_id=isset($_POST["course_id"])?$_POST["course_id"]:0;
        $course_id=isset($_GET["course_id"])?$_GET["course_id"]:$course_id;

        $sections=DB::table("qr_sections")
                ->select("qr_sections.*")
                ->where("qr_sections.course_id",$course_id)
                ->where("qr_sections.teacher_id",$teacher_id)
                ->get()->toArray();

        return json_encode($sections);
    }
}
