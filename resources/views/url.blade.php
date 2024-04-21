<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="{{url('assets/style.css')}}">
</head>
<body>
    <div class="container">
        <h1>URL Shortener</h1>
        @if(session()->has('errors'))
        <div class="alert alert-danger">
            <h3> {{session()->get('errors')->first('link')}} </h3>
        </div>
        @endif

        @if(Session::has('message'))
        <h3 class="alert alert-danger">{{Session::get('message')}}</h3>
        @endif

        @if(Session::has('link'))
        <h3 class="alert alert-danger"><a href="{{url(Session::get('link'))}}">{{url(Session::get('link'))}}</a>  is your shorten url</h3>
        @endif
        <form action="{{url('/')}}" method="post" id="urlForm">
            @csrf
            <label for="longUrl">Enter URL:</label>
            <input type="text" id="longUrl" name="link" required>
            <button type="submit">Shorten</button>
        </form>
        <div id="shortUrl"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>
