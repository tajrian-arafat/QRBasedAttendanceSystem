

@extends('global-content')

@section('styles')
<style type="text/css">
    .container {
        background:darkgrey;
    }
</style>
@endsection

@section('content')
    <div class="row" align="center" style="margin-top:200px; background:">
        <h3><center>ADMIN LOGIN</center></h3>
        <div style="background:repeating-linear-gradient(45deg, black, transparent 100px); max-width: 400px; max-height: 300px; border-radius:20px; padding:30px;">
            <div style="padding:10px;">
                <input class="form-control" type="email" placeholder="Email / Username" id="email" required="">
            </div>
            <div style="padding:10px;">
                <input class="form-control"type="password" placeholder="Password" id="password" required="">
            </div>
            <div style="padding-bottom:20px;">
                <button class="btn btn-primary" onclick="logInAttempt();">Log in</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function logInAttempt(){
            var email=$("#email").val();
            var password=$("#password").val();

            var this_url= '{{ env('APP_URL') }}'+'/admin-login';
            
            //API Connection

            $.ajax({
                url:this_url,
                method: 'POST',
                data:{
                    '_token':'{{ csrf_token() }}',
                    email:email,
                    password:password,
                },
                success: function(result){
                    result=JSON.parse(result);

                    if(result.status==200){
                        var this_url= '{{ env('APP_URL') }}'+'/adminhome';
                        window.location.href=this_url;
                    }else{
                        swal('Email/Password wrong.');
                    }
                }
            });
        }
    </script>
@endsection
