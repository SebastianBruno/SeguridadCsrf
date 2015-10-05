<?php
    $success = false;
    if(isset($_POST['create'])){
        $db = new mysqli('localhost', 'root', '', 'csrf');

        if($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

        $result = $db->query("INSERT INTO users(username,password) VALUES ('".$_POST['username']."','".$_POST['password']."')");
        if($result) $success = true;

        $db->close();
    }
?>
<head>
    <title>CSRF proof of concept</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background-color: lightgoldenrodyellow">
    <div class="col-xs-6" style="background-color: lightskyblue;margin-left: auto; margin-right: auto;float: none;height: 100%;padding:50px 50px 0 50px;">
        <?php if($success): ?>
            <h2>Usuario creado correctamente!</h2>
        <?php else: ?>
            <h2>Hubo un problema al crear el usuario</h2>
        <?php endif; ?>
        <input class="form-control" style="height:60px;margin-top: 60px" type="submit" value="Volver" onclick="window.location='back.php';" />
    </div>
</body>