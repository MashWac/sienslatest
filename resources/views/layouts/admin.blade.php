<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!----fonts---->
    <link rel="icon" href="{{ url('/staticimg/fav.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

   
    <!-- Styles -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/light-bootstrap-dashboard.css?v=2.0.0 ') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        @include('layouts.inc.sidebar')
        <div class="main-panel">
            @include('layouts.inc.adminnav')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.inc.adminfooter')
        </div>
    </div>

    <!----Scripts--->
    <script src="{{ asset('admin_assets/js/core/jquery.3.2.1.min.js') }}" defer></script>
    <script src="{{ asset('admin_assets/js/core/imgdisplay.js') }}" defer></script>
    <script src="{{ asset('admin_assets/js/core/popper.min.js') }}" defer></script>
    <script src="{{ asset('admin_assets/js/core/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('admin_assets/js/core/demo.js') }}" defer></script>
    <script src="{{ asset('admin_assets/js/core/deletemessage.js') }}" defer></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/ww6ndjh5cphj6gljw4ajf646p4vtwmaryyf8yd00aa3ttu2k/tinymce/6/plugins.min.js" referrerpolicy="origin"></script>    <script>
        tinymce.init({
            selector: 'textarea#descript', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'powerpaste advcode table lists checklist casechange wordcount',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table | casechange'
        });
</script>
    @if(session('status'))
    <script>
        swal("{{session('status')}}")
    </script>
    @endif
    @yield('Scripts')

</body>
</html>
