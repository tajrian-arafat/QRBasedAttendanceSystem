
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

        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }
        input[type=text], select {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }

        input[type=submit] {
          width: 100%;
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }

        input[type=submit]:hover {
          background-color: #45a049;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper" style="max-width:1000px!important; padding-top: 100px">
        <div class="app-wrapper">
        <!--teachers-->
        <aside class="wallet">
            <h3>ADD TEACHERS</h3>

            <div>
              <form>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Instructor Name..">

                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email ...">

                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="Password ...">
              
                <input class="btn btn-primary" type="button" value="ADD" onclick="addInstructor()">
              </form>
            </div>
        </aside>

        <content class="transactions-wrapper">
            <h2>Instructors</h2>
            <div class="pt-4 list-group">

                <div class="row" style="align:center;" id="section-list">
                    <table>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                          </tr>
                          @foreach($teachers_data as $teacher)
                              <tr>
                                <td>{{$teacher->name}}</td>
                                <td>{{$teacher->email}}</td>
                                <td>{{$teacher->password}}</td>
                              </tr>
                          @endforeach
                    </table>
                </div>
            </div>
        </content>

        </div>

    </div>

@endsection

@section('scripts')
<script>

    function addInstructor(){

        var this_url = '{{ env('APP_URL') }}'+'/addInstructor';
        $.ajax({
            url: this_url,
            method:'POST',
            data:{
                '_token':'{{ csrf_token() }}',
                'name':$("#name").val(),
                'email':$("#email").val(),
                'password':$("#password").val(),
            },
            success: function(result){
                swal("Instructor Successfully Added.");

                location.reload();
            }
        });

    }
    
</script>
@endsection
