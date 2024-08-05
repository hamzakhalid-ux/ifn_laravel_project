<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>IFN | Dashboard</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"    />
<script  src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<!-- the css inside the <head> -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/> --}}
    {{-- <link rel="stylesheet" href="{{asset('vendor/jQuery-Menu-Editor/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')}}"> --}}

    <!-- (Recommended) Just before the closing body tag </body> -->
    {{-- <script type="text/javascript" src="{{asset('vendor/jquery-3.6.0/dist/jquery.min.js')}}"></script> --}}

    {{-- <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('vendor/jQuery-Menu-Editor/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/jQuery-Menu-Editor/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js')}}"></script>
    {{-- <script type="text/javascript" src="{{asset('vendor/jQuery-Menu-Editor/jquery-menu-editor.min.js')}}"></script> --}}


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<![endif]-->
@foreach($headerCssLinks as $link)
    <link href="{{asset($link)}}" type="text/css" rel="stylesheet" media="all">
@endforeach
@foreach($headerJsLinks as $link)
    <script src="{{asset($link)}}" type="text/javascript"></script>
@endforeach
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script>
        base_url = "{{ env('APP_URL') }}";
        siteUrl = "{{ env('APP_URL') }}";
        var previousUrl = "{{ url('admin/dashboard') }}";
</script>
