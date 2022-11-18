<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel Generate QR Code Examples</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Attendance QR Code</h2>
            </div>
            <div class="card-body" id="qr-div">

            </div>
        </div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    $(document ).ready(function() {
        makeRequest();
        setInterval(makeRequest, (3 * 1000));

    });

    function makeRequest (){
        $.ajax({url: "/QRBasedAttendanceSystem/public/getQR", success: function(result){
            $("#qr-div").html(result);
        }});
    }


</script>
