<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error - {{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.png') }}"/>

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
</head>
<body class="error-page bg-white">

<div>
    <div>
        <span class="error-page-item font-weight-bold">400</span>
    </div>
    <h4 class="mb-0 text-muted font-weight-normal">{{ $exception->getMessage() ?? 'Upps! Page Error!' }}</h4>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
</div>

</body>
</html>
