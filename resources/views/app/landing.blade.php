<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="css/icons.css"/>
    <link rel="stylesheet" href="css/app.css"/>

    <title>Markdown Wiki</title>
</head>
<body>
<div id="app" class="container">
    <div class="row">
        <router-view class="col-md-9 order-md-last">
        </router-view>
        <cat-tag class="col-md-3 order-md-first"></cat-tag>
    </div>
</div>

<script src="js/app.js"></script>
</body>
</html>