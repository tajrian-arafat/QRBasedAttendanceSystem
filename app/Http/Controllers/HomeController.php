<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function login(){

        return view('login')->with("teacher",1);
    }

    public function adminlogin(){

        return view('adminlogin')->with("teacher",0);
    }

    public function adminsLogin(){
        $email=isset($_POST["email"])?$_POST["email"]:0;
        $email=isset($_GET["email"])?$_GET["email"]:$email;

        $password=isset($_POST["password"])?$_POST["password"]:0;
        $password=isset($_GET["password"])?$_GET["password"]:$password;

        $sqlUsed=array();

        $userCheck=DB::table('qr_admins')->where('email',$email)->where('password',$password)->limit(1)->get()->toArray();

        $sqlUsed[]="SELECT * FROM qr_admins WHERE email=? AND password=? LIMIT 1";

        $status=200;
        if(empty($userCheck)){
            $status=400;
        }else{
            session(['admin_id' =>$userCheck[0]->id]);
        }

        return json_encode(array("status"=>$status,"data"=>$userCheck));
    }

    public function adminlogout(){
        session()->forget('admin_id');
        return view('adminlogin')->with("teacher",0);
    }

    public function logout(){
        session()->forget('teacher_id');
        return view('login')->with("teacher",1);
    }

    public function teacherLogin(){
        $email=isset($_POST["email"])?$_POST["email"]:0;
        $email=isset($_GET["email"])?$_GET["email"]:$email;

        $password=isset($_POST["password"])?$_POST["password"]:0;
        $password=isset($_GET["password"])?$_GET["password"]:$password;

        $sqlUsed=array();

        $userCheck=DB::table('qr_teachers')->where('email',$email)->where('password',$password)->limit(1)->get()->toArray();

        $sqlUsed[]="SELECT * FROM qr_teachers WHERE email=? AND password=? LIMIT 1";

        $status=200;
        if(empty($userCheck)){
            $status=400;
        }else{
            session(['teacher_id' =>$userCheck[0]->id]);
        }

        return json_encode(array("status"=>$status,"data"=>$userCheck));
    }

    public function home(){

        $teacher_id=session('teacher_id');

        $courses=DB::table("qr_sections")
                ->select("qr_sections.course_id","qr_courses.name")
                ->leftjoin("qr_courses","qr_courses.id","=","qr_sections.course_id")
                ->where("qr_sections.teacher_id",$teacher_id)
                ->distinct("qr_courses.id")
                ->get()->toArray();

        $sqlUsed[]="SELECT qr_sections.course_id,qr_courses.name FROM qr_sections LEFT JOIN qr_courses ON qr_courses.id=qr_sections.course_id WHERE qr_sections.teacher_id=? GROUP BY qr_courses.id";

        return view('teacher-home')
               ->with("teacher_id",$teacher_id)
               ->with("courses_data",$courses);
    }

    public function adminhome(){

        $admin_id=session('admin_id');

        $teachers=DB::table("qr_teachers")
                ->select("qr_teachers.*")
                ->get()->toArray();

        return view('admin-home')
               ->with("admin_id",$admin_id)
               ->with("teachers_data",$teachers);
    }

    public function searchAttendees(){
        $search=isset($_POST["search"])?$_POST["search"]:0;
        $search=isset($_GET["search"])?$_GET["search"]:$search;

        $raw="(name LIKE '%".$search."%' OR student_id LIKE '%".$search."%' OR email LIKE '%".$search."%')";
        $students=DB::table("qr_students")->whereRaw($raw)->get()->toArray();

        $sqlUsed[]="SELECT * FROM qr_students WHERE name LIKE '%".$search."%' OR student_id LIKE '%".$search."%' OR email LIKE '%".$search."%'";
        return json_encode($students);
    }

    public function addInstructor(){

        $name=isset($_POST["name"])?$_POST["name"]:"";
        $name=isset($_GET["name"])?$_GET["name"]:$name;

        $email=isset($_POST["email"])?$_POST["email"]:"";
        $email=isset($_GET["email"])?$_GET["email"]:$email;

        $password=isset($_POST["password"])?$_POST["password"]:"";
        $password=isset($_GET["password"])?$_GET["password"]:$password;

        if(!empty($name) && !empty($email) && !empty($password)){
            DB::table("qr_teachers")
                ->insert([
                    "name" => $name,
                    "email" => $email,
                    "password" => $password,
                ]);
        }

    }

    public function enrollAttendee(){
        $section_id=isset($_POST["section_id"])?$_POST["section_id"]:0;
        $section_id=isset($_GET["section_id"])?$_GET["section_id"]:$section_id;
        $section_id='"'.$section_id.'"';

        $student_id=isset($_POST["student_id"])?$_POST["student_id"]:0;
        $student_id=isset($_GET["student_id"])?$_GET["student_id"]:$student_id;

        $getCurrentGroup=DB::table("qr_students")->where("id",$student_id)->value("section_ids");

        $sqlUsed[]="SELECT section_ids FROM qr_students WHERE id=".$student_id;

        $getCurrentGroup=explode(",",$getCurrentGroup);
        $getCurrentGroup[]=(string)$section_id;
        $getCurrentGroup=array_unique($getCurrentGroup);
        $getCurrentGroup=implode(",",$getCurrentGroup);

        DB::table("qr_students")->where("id",$student_id)->update(["section_ids"=>$getCurrentGroup]);

        $sqlUsed[]="UPDATE qr_students SET section_ids=? WHERE id=".$student_id;
    }

    public function removeAttendee(){

        /*
            -- Called from teacher-section.blade with ajax from function removeAttendee
            -- Paased section_id and student_id
            -- 
        */

        $section_id=isset($_POST["section_id"])?$_POST["section_id"]:0;
        $section_id=isset($_GET["section_id"])?$_GET["section_id"]:$section_id;
        $section_id='"'.$section_id.'"';

        $student_id=isset($_POST["student_id"])?$_POST["student_id"]:0;
        $student_id=isset($_GET["student_id"])?$_GET["student_id"]:$student_id;

        $getCurrentGroup=DB::table("qr_students")->where("id",$student_id)->value("section_ids");
        $sqlUsed[]="SELECT section_ids FROM qr_students WHERE id=".$student_id;

        $getCurrentGroup=explode(",",$getCurrentGroup);

        $key = array_search($section_id, $getCurrentGroup);
        if($key>-1){
            unset($getCurrentGroup[$key]);
        }
        $getCurrentGroup=array_values(array_unique($getCurrentGroup));
        $getCurrentGroup=implode(",",$getCurrentGroup);

        DB::table("qr_students")->where("id",$student_id)->update(["section_ids"=>$getCurrentGroup]);

        $sqlUsed[]="UPDATE qr_students SET section_ids=? WHERE id=".$student_id;
    }

    public function section(){

        $section_id=isset($_POST["sid"])?$_POST["sid"]:0;
        $section_id=isset($_GET["sid"])?$_GET["sid"]:$section_id;

        $course_id=isset($_POST["cid"])?$_POST["cid"]:0;
        $course_id=isset($_GET["cid"])?$_GET["cid"]:$course_id;

        $details=DB::table("qr_sections")
                ->select("qr_sections.*","qr_courses.name as course_name")
                ->leftjoin("qr_courses","qr_courses.id","=","qr_sections.course_id")
                ->where("qr_sections.id",$section_id)
                ->where("qr_sections.course_id",$course_id)
                ->get()->toArray();

        $sqlUsed[]="SELECT qr_sections.*,qr_courses.name AS course_name FROM qr_sections LEFT JOIN qr_courses ON qr_courses.id=qr_sections.course_id WHERE qr_sections.id=? AND qr_sections.course_id=?";

        $raw="section_ids LIKE '%\"".$section_id."\"%'";
        $students=DB::table("qr_students")
                ->select("qr_students.*")
                ->whereRaw($raw)
                ->get()->toArray();

        $sqlUsed[]="SELECT qr_students.* FROM qr_students WHERE qr_students.section_ids LIKE '%\"".$section_id."\"%'";

        $total_attendances=DB::table("qr_attendance_data")->where("section_id",$section_id)->distinct("date")->count();

        $sqlUsed[]="SELECT COUNT(id) FROM qr_attendance_data WHERE section_id=? GROUP BY date";

        foreach($students as $k=>$student){
            $total_present=DB::table("qr_attendance_data")->where("student_id",$student->id)->where("section_id",$section_id)->where("attendance",1)->count();

            $sqlUsed[]="SELECT COUNT(*) FROM qr_attendance_data WHERE student_id=? AND section_id=? AND attendance=1";

            if($total_attendances>0){
                $students[$k]->percentage=floor(($total_present*100)/$total_attendances);
            }else{
                $students[$k]->percentage=floor($total_present*100);
            }

            $students[$k]->total_attendances=$total_attendances;
            $students[$k]->total_present=$total_present;
        }

        return view('teacher-section')
                ->with("details",$details)
               ->with("students",$students);
    }

    public function getAttendeeAttendance(){

        $student_id=isset($_POST["student_id"])?$_POST["student_id"]:0;
        $student_id=isset($_GET["student_id"])?$_GET["student_id"]:$student_id;

        $section_id=isset($_POST["section_id"])?$_POST["section_id"]:0;
        $section_id=isset($_GET["section_id"])?$_GET["section_id"]:$section_id;

        $attendance_records=DB::table("qr_attendance_data")
                                ->where("student_id",$student_id)
                                ->where("section_id",$section_id)
                                ->orderby("date","desc")
                                ->get()->toArray();

        $sqlUsed[]="SELECT qr_attendance_data.* FROM qr_attendance_data WHERE student_id=? AND section_id=? ORDER BY date DESC";

        return json_encode($attendance_records);

    }

    public function editAttendance(){
        $attendance_id=isset($_POST["attendance_id"])?$_POST["attendance_id"]:0;
        $attendance_id=isset($_GET["attendance_id"])?$_GET["attendance_id"]:$attendance_id;

        $attendance=isset($_POST["attendance"])?$_POST["attendance"]:0;
        $attendance=isset($_GET["attendance"])?$_GET["attendance"]:$attendance;

        DB::table("qr_attendance_data")
        ->where("id",$attendance_id)
        ->update([
            "attendance"=>$attendance
        ]);

        $sqlUsed[]="UPDATE qr_attendance_data SET attendance=? WHERE id=?";
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

        $sqlUsed[]="SELECT qr_sections.* FROM qr_sections WHERE course_id=? AND teacher_id=?";

        return json_encode($sections);
    }
}
