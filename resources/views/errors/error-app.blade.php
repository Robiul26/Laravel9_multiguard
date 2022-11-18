<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @yield('title', 'Access Denied !!')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 150px;
            background-color: #C4CCD9;
        }

        .error-main {
            background-color: #fff;
            box-shadow: 0px 10px 10px -10px #5D6572;
        }

        .error-main h1 {
            font-weight: bold;
            font-size: 100px;
            text-shadow: 2px 4px 5px #6E6E6E;
        }
    </style>
</head>

<body>

    @yield('content')

</body>

</html>
