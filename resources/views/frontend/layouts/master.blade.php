<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drag And Drop</title>

    {{-- include bootstrap css  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    @stack('style')

</head>
<body>
    @include('frontend.layouts.header')
  
    {{-- main content of page goes here  --}}
    @yield('content')

    @include('frontend.layouts.footer')

    @stack('script')
    <script>
        // redirect if login 
        if (sessionStorage.getItem('token')) {
                document.querySelector('.login').classList.add('d-none')
                document.querySelector('.logout').classList.remove('d-none')
                document.querySelector('.logout').classList.add('d-block')

            }
    </script>
</body>
</html>