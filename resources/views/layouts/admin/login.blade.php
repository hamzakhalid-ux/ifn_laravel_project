<!DOCTYPE html>
<html lang="en">
    {{-- <head>
        @foreach($headSections as $section)
        @include("components/admin/$section")
        @endforeach
        <style>
            .iti.iti--allow-dropdown.iti--separate-dial-code{
                width: 100%;
            }
        </style>
</head> --}}
    <head>
        <title>IFN</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/dataTables.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      />

        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/slick.js')}}"></script>
        <script src="{{asset('assets/js/apexcharts.min.js')}}"></script>
        <script src="{{asset('assets/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.mCustomScrollbar.js')}}"></script>
        <script src="{{asset('assets/js/custom.js')}}"></script>
        <script src="{{asset('js/indexpage.js')}}"></script>
    </head>
    <body class="{{$main_class}}">
        @foreach($mainSections as $section)
        @include("components/admin/$section")
        @endforeach

        {{-- @foreach($footSections as $section)
        @include("components/admin/$section")
        @endforeach --}}

    </body>
</html>
