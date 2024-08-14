<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <meta content="{{ config('app.name') }}" name="description"/>
    <meta content="{{ config('app.name') }}" name="author"/>
    <meta name="_token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <style>
        footer {
            width: 100%;
            padding: 20px 0;
            border: 1px solid #eee;
            margin-top: 40px;
        }
    </style>
</head>
<body>

@include("layouts.header")

@yield("content")

@include("layouts.footer")

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script>
    $(document).on("keyup", "#mobile_number", function (e) {
        let mobile_string = $(this).val();
        if (parseInt(mobile_string)) {
            $(this).val(parseInt(mobile_string));
        } else {
            $(this).val("");
        }
    });

    $(document).on("keyup", "#pan_card", function (e) {
        let pan_card = $(this).val();
        $(this).val(pan_card.toUpperCase());
    });
</script>
</body>
</html>
