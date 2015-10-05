<?php
    session_start();

    //Chequear que sea el dueño el que se esta eliminando
    if(isset($_GET['usuario']) && isset($_SESSION['userId'])){
        $db = new mysqli('localhost', 'root', '', 'csrf');

        if($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

        $result = $db->query("DELETE FROM users WHERE userId='".$_GET['usuario']."'");
        if($result) $message = "El usuario ha sido eliminado correctamente!";
        else $message = "Hubo un problema al eliminar al usuario";
        $db->close();
    }else $message = "Usted no tiene permisos para realizar esta operacion"
?>
<html>
<head>
    <title>CSRF proof of concept</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background-color: lightgoldenrodyellow">
    <div class="col-xs-6" style="background-color: lightskyblue;margin-left: auto; margin-right: auto;float: none;height: 100%;padding:50px 50px 0 50px;">
        <h2><?php echo $message; ?></h2>
        <input class="form-control" style="height:60px;margin-top: 60px" type="submit" value="Volver" onclick="window.location='back.php';" />
    </div>
</body>
</html>