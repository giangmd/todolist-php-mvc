<?php
    use App\App\App;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?> - ToDoList PHP MVC</title>
    <link rel="stylesheet" type="text/css" href="<?php echo App::get('config')['APP_URL'] . '/public/assets/css/bootstrap.min.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo App::get('config')['APP_URL'] . '/public/assets/css/daterangepicker.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo App::get('config')['APP_URL'] . '/public/assets/css/fullcalendar.min.css' ?>" />
    <style type="text/css">
        body {
            font-size: 16px;
        }
        a {
            text-decoration: none;
        }
        a:hover, a:focus, a:visited {
            outline: none;
            text-decoration: none;
        }
        header {
            padding: 40px 0;
        }
        section .content {
            padding: 40px 0;
            border-top: 1px solid #d3d9df;
        }
        .content {
            width: 100%;
        }
        label.error {
            display: inline-block;
            width: 100%;
            text-align: left;
            font-size: 0.8em;
            color: #ff003b;
        }
        .box-view {
            display: none;
        }
        .box-view.show {
            display: block;
        }
        .handle {
            margin: 20px 0;
        }
        .view-handle .btn {
            margin-right: 15px;
        }
        .view-handle .btn:last-child {
            margin-right: 0;
        }
        .logo {
            font-size: 2em;
            color: #00a9ff;
        }
        .logo a {
            color: inherit;
        }
        .logo a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>