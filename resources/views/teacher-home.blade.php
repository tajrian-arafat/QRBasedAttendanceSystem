
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
        <!--courses-->
        <aside class="wallet">
            <h2>My Programs</h2>
            <div class="pt-4 text-center list-group">
                @foreach($courses_data as $course)
                    <button id="course-list-{{$course->course_id}}" type="button" class="courses list-group-item list-group-item-action" onclick="fetchGroupList('{{$course->course_id}}');">{{$course->name}}</button>
                @endforeach

            </div>

            <div class="cards"></div>
        </aside>

        <content class="transactions-wrapper">
            <h2>Groups</h2>
            <div class="pt-4 list-group">

                <div class="row" style="align:center;" id="section-list">
                    <b><i>Please Click a Program Name To See Groups</i></b>
                </div>
            </div>
        </content>

        </div>

    </div>

@endsection

@section('scripts')
<script>
    function fetchGroupList(course_id){

        $('.courses').removeClass('active');
        $('#course-list-'+course_id).addClass('active');

        var this_url = '{{ env('APP_URL') }}'+'/getGroups';
        $.ajax({
            url: this_url,
            method:'POST',
            data:{
                '_token':'{{ csrf_token() }}',
                'teacher_id':'{{$teacher_id}}',
                'course_id':course_id
            },
            success: function(result){
                let sectionHtml="";
                result=JSON.parse(result);
                $.each(result, function(key,data){
                    sectionHtml=sectionHtml+`<button id="section-list-${data.id}" type="button" class="sections list-group-item list-group-item-action" onclick="gotoGroupDetails('${data.id}','${data.course_id}');">${data.name}</button>`;
                });
                $("#section-list").html(sectionHtml);
            }
        });

    }

    function gotoGroupDetails(section_id,course_id) {

        var this_url = '{{ env('APP_URL') }}'+'/section?cid='+course_id+'&sid='+section_id;
        window.location.href=this_url;

    }
</script>
@endsection
