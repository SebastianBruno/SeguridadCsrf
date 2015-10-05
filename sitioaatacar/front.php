<?php session_start(); ?>
<html>
<head>
    <title>CSRF proof of concept</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background-color: lightgoldenrodyellow">
    <?php if(!isset($_SESSION['userId'])) : ?>
        <h1>Logueate para usar este sitio!</h1>
    <?php else: ?>
        <h1>Bienvenido <?php echo $_SESSION['username']; ?>!</h1>
    <?php endif; ?>
</body>
</html>