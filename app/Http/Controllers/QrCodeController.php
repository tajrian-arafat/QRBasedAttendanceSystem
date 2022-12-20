<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use DB;

class QrCodeController extends Controller
{
    public function index()
    {
      $section_id=isset($_POST["sid"])?$_POST["sid"]:0;
      $section_id=isset($_GET["sid"])?$_GET["sid"]:$section_id;

      return view('qrcode')->with('section_id',$section_id);
    }

    public function getQR(){

        $section_id=isset($_POST["section_id"])?$_POST["section_id"]:0;
        $section_id=isset($_GET["section_id"])?$_GET["section_id"]:$section_id;
        $section_salting=$section_id*1999;

        $datetime=date('Y-m-d H:i:s', strtotime("+6 hours"));
        $date=date('Y-m-d', strtotime("+6 hours"));

        $random_number=$section_salting."-".time()*time();
        $myQR=QrCode::size(300)->generate($random_number);

        DB::table("qr_validation_storage")
                     ->where("qr_section_id",$section_id)
                     ->delete();

        DB::table("qr_validation_storage")
            ->insert([
                "create_datetime" => $datetime,
                "qr_hash"=>$random_number,
                "qr_section_id"=>$section_id
            ]);

        $checkRecord=DB::table("qr_attendance_data")->where("section_id",$section_id)->where('date',$date)->count();
        if($checkRecord==0){
            $raw="section_ids LIKE '%".$section_id."%'";
            $students=DB::table("qr_students")
                    ->select("qr_students.id")
                    ->whereRaw($raw)
                    ->get()->toArray();

            $attendanceArray=array();
            foreach($students as $k=>$student){
                $attendanceArray[$k]['date']=$date;
                $attendanceArray[$k]['section_id']=$section_id;
                $attendanceArray[$k]['attendance']=0;
                $attendanceArray[$k]['student_id']=$student->id;
            }

            DB::table("qr_attendance_data")->insert($attendanceArray);
        }

        return $myQR;
    }

    public function giveAttendance(){

        $student_id=isset($_POST["student_id"])?$_POST["student_id"]:0;
        $student_id=isset($_GET["student_id"])?$_GET["student_id"]:$student_id;

        $device_id=isset($_POST["device_id"])?$_POST["device_id"]:0;
        $device_id=isset($_GET["device_id"])?$_GET["device_id"]:$device_id;

        $qr_data_full=isset($_POST["qr_data"])?$_POST["qr_data"]:"";
        $qr_data_full=isset($_GET["qr_data"])?$_GET["qr_data"]:$qr_data_full;
        $qr_data=explode("-",$qr_data_full);

        $qr_hash=isset($qr_data[1])?$qr_data[1]:"";
        $section_id=isset($qr_data[0])?(int)$qr_data[0]/1999:"";

        $date=date('Y-m-d', strtotime("+6 hours"));

        $returnMessage="";
        $statusCode=200;

        $checkDeviceExists=DB::table("qr_attendance_data")->where("section_id",$section_id)->where("date",$date)->where("device_id",$device_id)->count();

        if($checkDeviceExists==0){

            $checkQRvalidity=DB::table("qr_validation_storage")->where("qr_section_id",$section_id)->where("qr_hash",$qr_data_full)->count();

            if($checkQRvalidity>0){
                DB::table("qr_attendance_data")
                    ->where("student_id",$student_id)
                    ->where("section_id",$section_id)
                    ->where("date",$date)
                    ->update([
                        "attendance"=>1,
                        "device_id"=>$device_id
                    ]);
                $returnMessage="Attendance Successfully Added. Thanks for being at Class.";
            }else{
                $statusCode=200;
                $returnMessage="Wrong/Old QR Detected.Please Try again with Current QR Code.";

                //Attendance Attempt with Wrong/Old QR -- May be shared picture with friends.
            }

        }else{
            $statusCode=200;
            $returnMessage="Proxy Attendance Attempt Detected. Better Luck Next Time.";

            //Duplicate Attendance Attempt Detected.
        }

        $returnArray=array("statusCode"=>$statusCode, "message"=>$returnMessage);

        return json_encode($returnArray);
    }
}
