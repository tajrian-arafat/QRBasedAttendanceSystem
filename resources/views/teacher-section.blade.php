@extends('global-content')

@section('styles')
<style>
        /* fonts */
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Roboto:300,400');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }

        h2 {
            margin: 0px;
            font-weight: 400;
            color: #707584;
            font: 24px/24px 'Open Sans', sans-serif;
        }

        h3 {
            margin: 0px 0px 5px;
            font-weight: 600;
            font-size: 18px;
            line-height: 18px;
        }

        .wrapper {
            width: 100vw;
            font-family: 'Open Sans', sans-serif;
        }

        .app-wrapper {
            background-color: #fff;
            height: 700px;
            min-width: 800px;
            border-radius: 8px;
            display: flex;

            -webkit-box-shadow: 0px 8px 24px 4px rgba(32,31,30,,1);
            -moz-box-shadow: 0px 8px 24px 4px rgba(32,31,30,,1);
            box-shadow: 0px 8px 24px 4px rgba(32,31,30,1);
        }

        .wallet {
            width: 360px;
            background-color: #f2f2f2;
            height: 100%;
            border-top-left-radius: inherit;
            border-bottom-left-radius: inherit;
            padding: 50px;
        }

        .wallet h2 {
            display:inline-block;
        }

        .transactions-wrapper {
            width: 520px;
            padding: 50px;
        }

        .total-balance {
            display: inline-block;
            float: right;
            font-weight: 600;
            font-size: 32px;
            color: #444750;
        }
        .total-balance::before {
            content: '$';
        }

        .transactions {
            margin-top: 60px;
            border-top: 1px solid #e5e5e5;
            padding-top: 50px;
            height: 550px;
            overflow: scroll;
        }

        .transactions.show {
            animation: fade-in .3s 1;
        }

        .transactions::-webkit-scrollbar {
            display: none;
        }

        .transaction-item {
            margin-bottom: 45px;
        }

        .transaction-item {
            padding-left: 40px;
            position: relative;
            display: flex;
        }
        .transaction-item::before {
            position: absolute;
            content: '';
            border: 2px solid #e1e1e1;
            border-radius: 50%;
            height: 25px;
            width: 25px;
            left: 0px;
            top: 10px;
            box-sizing: border-box;
            box-sizing: border-box;
            vertical-align: middle;
            color: #666666;
        }

        .transaction-item.credit::before {
            content: '\002B';
            font-size: 25px;
            line-height: 19px;
            padding: 0px 4px 0px;
        }

        .transaction-item.credit .transaction-item_amount .amount,
        .transaction-item.credit .transaction-item_amount span{
            color: #66cc33;
        }

        .transaction-item.debit::before {
            content: '\2212';
            font-size: 20px;
            line-height: 21px;
        padding: 0px 5px;
        }

        .transaction-item.debit .transaction-item_amount .amount,
        .transaction-item.debit .transaction-item_amount span{
            color: #8393ca;
        }

        .transaction-item span.details {
            font-size: 14px;
            line-height: 14px;
            color: #999;
        }

        .transaction-item_details {
            width: 270px;
        }

        .transaction-item_amount {
            width: 110px;
            text-align: right;
        }
        .transaction-item_amount span {
            font-weight: 600;
            font-size: 18px;
            line-height: 45px;
        }

        .transaction-item_amount .amount {
            font-weight: 600;
            font-size: 18px;
            line-height: 45px;
            position: relative;
            margin: 0px;
            display: inline-block;
            text-indent: -15px;
        }

        /* Hide + and - */
        .transaction-item_amount .amount::first-letter {
            color: transparent !important;
        }

        .cards {
            margin-top: 60px;
        }

        .credit-card {
            padding: 15px;
            background-color: #fff;
            margin-bottom: 45px;
                border-radius: 3px;
            border: 2px solid #e1e1e1;
                font-family: 'Roboto', sans-serif;
                cursor: pointer;
                transition: .1s ease-in-out;
        }
        .credit-card:hover {
            transform: scale(1.07);
        }

        .credit-card.active {
            border-color: #8393ca;
            border-width: 3px;
        }

        .card-image {
            display: inline-block;
            height: 40px;
            width: 58px;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .credit-card.visa .card-image,
        .card-image.visa {
            background-image: url("https://dl.dropboxusercontent.com/s/lwvqznj7lwwkrkk/visa.png?dl=0");
        }

        .credit-card.amex .card-image,
        .card-image.amex {
            background-image: url('https://dl.dropboxusercontent.com/s/e3toeu643kc4xqr/amex.png?dl=0');
        }

        .credit-card.mc .card-image,
        .card-image.mc {
            background-image: url('https://dl.dropboxusercontent.com/s/8uh687u5tcchz9s/mastercard.png?dl=0');
        }

        .credit-card_expiration {
            color: #b3b3b3;
        }

        .credit-card_number {
            color: #666666;
        }

        .card-list {
            margin-top: 20px;
        }

        .card-list .card-image {
            cursor: pointer;
            margin-right: 15px;
            transition: .1s;
        }

        .card-list .card-image:hover {
            transform: scale(1.1);
        }

        /* animations */
        @keyframes fade-in {
            0% {
                opacity: 0;
            }
        100% {
            opacity: 1;
        }
        }

        /* media queries */
        @media(max-width:810px) {
            .wrapper {
                border-radius: 8px;
            }
            .wallet {
                width: 100%;
                border-top-right-radius: inherit;
                padding-bottom: 25px;
            }
            .cards {
                margin-top: 25px;
            }
            .app-wrapper {
                -webkit-flex-direction: column;
            flex-direction: column;
                width: 100%;
                border-top-right-radius: inherit;
                height: initial;
            }
            .credit-card {
                width: calc(50% - 25px);
            max-width: 260px;
            display: inline-block;
            margin-right: 25px;
                margin-bottom: 25px;
            text-align: left;
            }
            .credit-card:nth-of-type(2) {
                margin-right: 0px;
            }
            .transactions {
                height: initial;
            }
            .transactions-wrapper {
                width: 100%;
            }
            .transaction-item_amount {
                width: calc(100% - 270px);
            }
        }

        @media(max-width:530px) {
            h3 {
                line-height: 24px;
            }
            .cards {
                text-align: center;
            }
            .credit-card {
                width: calc(100% - 25px);
            max-width: 260px;
            }
            .credit-card:nth-of-type(2) {
                margin-right: 25px;
            }
            .credit-card:last-of-type {
                margin-bottom: 0px;
            }
            .total-balance {
                    font-size: 22px;
            }
            .transaction-item_amount {
                width: 110px;
            }
        }

        @media(max-width: 390px) {
            .wallet {
                padding: 50px 25px;
            }
            .transactions-wrapper {
                padding: 50px 25px;
            }
            h2 {
                font: 18px/24px 'Open Sans', sans-serif;
            }
        }
    </style>
@endsection



@section('content')

<div class="wrapper" style="max-width:1000px!important; padding-top: 100px">
    <div class="app-wrapper">
        <aside class="wallet">
            <h2>{{$details[0]->course_name}} - {{$details[0]->name}}</h2>
            <div class="pt-4 text-center list-group">
                <button type="button" class="list-group-item list-group-item-action" onclick="generateQRCode();">Generate QR Code</button>
                <button type="button" class="list-group-item list-group-item-action" onclick="studentModal('add');">Add student</button>
                <button type="button" class="list-group-item list-group-item-action" onclick="studentModal('remove');">Remove Attendee</button>

            </div>

            <div class="cards"></div>
        </aside>



        <content class="transactions-wrapper">
            <h2>Attendee List</h2>
            <div class="pt-4 list-group">

                <table class="table" style="min-width:140%;">
                    <thead>
                        <tr>
                        <th scope="col">Attendee Name</th>
                        <th scope="col">Attendee Id</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $key => $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->student_id}}</td>
                                <td>{{$student->percentage}} ({{$student->total_present}}/{{$student->total_attendances}})</td>
                                <td onclick="fetchAttendeeAttendance('{{$student->id}}','{{$details[0]->id}}','{{$student->student_id}}');"><span class="material-icons" style="color:green; cursor:pointer;">manage_accounts</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </content>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentModalLabel">Search Attendee Database</h5>
      </div>
      <div class="modal-body">
      <table class="table table-dark">
        <thead>

        </thead>
        <tbody id="studentModal-content">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Search with student ID/Name/Email" id="student-search"/>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" onclick="searchAttendee();">Search</button>
                    <input type="hidden" id="action-type"/>
                </div>
            </div>
            <div id="student-list-search">

            </div>
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel"><p id="modal-title"></p></h5>
      </div>
      <div class="modal-body">
      <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Attendance</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="modal-content">

        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection





@section('scripts')
    <script>

        function studentModal(action_type){
            $("#action-type").val(action_type);
            $("#studentModal").modal("show");
        }

        function fetchAttendeeAttendance(student_id,section_id,student_ref_id) {

            $("#modal-title").html("Attendee ID: "+student_ref_id);

            var this_url = '{{ env('APP_URL') }}'+'/getAttendeeAttendance';
            $.ajax({
                url: this_url,
                method:'POST',
                data:{
                    '_token':'{{ csrf_token() }}',
                    'student_id':student_id,
                    'section_id':section_id
                },
                success: function(result){
                    let listHtml="";
                    result=JSON.parse(result);
                    $.each(result, function(key,data){
                        let date=data.date;
                        let attendance=data.attendance;

                        let present_selected="";
                        let absent_selected="";

                        if(attendance==1){
                            present_selected="selected";
                        }else{
                            absent_selected="selected";
                        }

                        listHtml=listHtml+`<tr><td>${date}</td>
                        <td><select id="attendance-${data.id}" class="form-control">
                            <option value="1" ${present_selected}>Present</option>
                            <option value="0" ${absent_selected}>Absent</option>
                        </select></td>
                        <td>  <button type="button" class="btn btn-primary" onclick="editAttendance('${data.id}')">Save</button></td></tr>`;
                    });

                    if(result.length > 0){
                        $("#modal-content").html(listHtml);
                    }else{
                        $("#modal-content").html("<center>No Attendance Available</center>");
                    }


                    $("#attendanceModal").modal("show");
                }
            });

        }

        function editAttendance(attendance_id){
            var attendance=$("#attendance-"+attendance_id).val();
            var this_url = '{{ env('APP_URL') }}'+'/editAttendance';
            $.ajax({
                url: this_url,
                method:'POST',
                data:{
                    '_token':'{{ csrf_token() }}',
                    'attendance_id':attendance_id,
                    'attendance':attendance
                },
                success: function(result){
                    $("#attendanceModal").modal("hide");

                    swal("Attendance Record Successfully Updated.");
                }
            });

        }

        function searchAttendee(){
            var search=$("#student-search").val();
            var action_type=$("#action-type").val();

            var this_url = '{{ env('APP_URL') }}'+'/searchAttendees';
            $.ajax({
                url: this_url,
                method:'POST',
                data:{
                    '_token':'{{ csrf_token() }}',
                    'search':search
                },
                success: function(result){
                    result=JSON.parse(result);

                    var listHtml="";
                    $.each(result, function(key,data){
                        if(action_type=='add'){
                            var button_html='<div class="col-md-4"><button class="btn btn-success" onclick="enrollAttendee('+data.id+')">Enroll</button></div>';
                        }else{
                            var button_html='<div class="col-md-4"><button class="btn btn-danger" onclick="removeAttendee('+data.id+')">Remove</button></div>';

                        }
                        listHtml=listHtml+`<div class="row" style="border-radius:10px;border-color:black; padding:15px;">
                            <div class="col-md-8">
                                ${data.name} - ${data.student_id}
                            </div>
                            ${button_html}
                        </div>`;
                    });

                    $("#student-list-search").html(listHtml);
                }
            });
        }

        function enrollAttendee(student_id){

            var this_url = '{{ env('APP_URL') }}'+'/enrollAttendee';
            $.ajax({
                url: this_url,
                method:'POST',
                data:{
                    '_token':'{{ csrf_token() }}',
                    'student_id':student_id,
                    'section_id':'{{$details[0]->id}}'
                },
                success: function(result){
                    $("#studentModal").modal("hide");
                    swal("Attendee Successfully Enrolled to This Section.");

                    location.reload();
                }
            });

        }

        function removeAttendee(student_id){
            var this_url = '{{ env('APP_URL') }}'+'/removeAttendee';
            var section_id='{{$details[0]->id}}';
            $.ajax({
                url: this_url,
                method:'POST',
                data:{
                    '_token':'{{ csrf_token() }}',
                    'student_id':student_id,
                    'section_id':section_id.toString()
                },
                success: function(result){
                    $("#studentModal").modal("hide");
                    swal("Attendee Successfully Removed From This Section.");

                    location.reload();
                }
            });
        }

        function generateQRCode(){
            var section_id='{{$details[0]->id}}';
            var this_url = '{{ env('APP_URL') }}'+'/generate-qrcode?sid='+section_id;

            window.open(this_url, "_blank");

        }
    </script>
@endsection
