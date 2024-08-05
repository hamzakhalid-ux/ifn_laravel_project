<head>
    <title>{{$title ?? 'IFN'}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}" />

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/slick.js')}}"></script>
    <script src="{{asset('assets/js/apexcharts.min.js')}}"></script>
    <script src="{{asset('js/indexpage.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.mCustomScrollbar.js')}}"></script>
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        base_url = "{{ env('APP_URL') }}";
        siteUrl = "{{ env('APP_URL') }}";
    </script>
</head>
