<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?> - ToDoList PHP MVC</title>
    <style type="text/css">
        h1, h2 {
            width: 100%;
        }
        a {
            text-decoration: none;
        }
        a:hover, a:focus, a:visited {
            outline: none;
            text-decoration: none;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .container {
            width: 80%;
            display: flex;
            flex: 1;
            margin: auto;
            text-align: center;
        }
        .left, .right {
            display: block;
            float: left;
            clear: both;
        }
        .left {
            width: 30%;
            padding: 0 15px;
        }
        .right {
            width: 70%;
            padding: 0 15px;
        }
        .info {
            color: #00a9ff;
        }
        .danger {
            color: #ff003b;
        }
        .btn {
            cursor: pointer;

        }
        form {
            width: 100%;
            font-size: 18px;
        }
        input, select {
            width: 100%;
            border: 1px solid #ddd;
            padding: 10px 15px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>