<?php
    session_start();
    $wrongLogin = false;

    //Si se esta logueando
    if(isset($_POST['login'])){
        $db = new mysqli('localhost', 'root', '', 'csrf');

        if($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

        $result = $db->query("SELECT userId,username FROM users WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'");
        $user = $result->fetch_assoc();

        if($result->num_rows != 0){
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['username'] = $user['username'];
        }else $wrongLogin = true;

        $db->close();
    }
    elseif(isset($_POST['logout'])){
        session_unset();
    }
?>

<html>
<head>
    <title>CSRF proof of concept</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background-color: lightgoldenrodyellow">

<div class="col-xs-6" style="background-color: lightskyblue;margin-left: auto; margin-right: auto;float: none;height: 100%;padding:50px 50px 0 50px;">
<?php if(!isset($_SESSION['userId'])): ?>
    <?php if($wrongLogin): ?>
        <h2>Usted no existe en nuestra base de datos</h2>
    <?php endif; ?>
    <h1>Loguearse</h1>
    <form id="loginForm" method="post" role="form">
        <input class="form-control" name="username" type="text" placeholder="Username">
        <input class="form-control" name="password" type="password" placeholder="Password">
        <input class="form-control" type="submit" name="login" value="Login">
    </form>
<?php else: ?>
    <div class="row">
        <form id="logoutForm" method="post" style="width: auto;display: inline-block;float: right;" role="form">
            <input class="form-control" type="submit" name="logout" value="Logout">
        </form>
    </div>
    <h2>Logueado como <?php echo $_SESSION['username']; ?></h2>
    <div style="width: 100%;height: 170px;">
        <h3>Crear usuario</h3>
        <form class="col-xs-6" method="post" action="crear_usuario.php" role="form">
            <input class="form-control" name="username" type="text" placeholder="Username">
            <input class="form-control" name="password" type="password" placeholder="Password">
            <input class="form-control" type="submit" name="create" value="Crear">
        </form>
    </div>
    <h3>Eliminar usuario:</h3>
    <div style="padding: 0 20px 0 20px;margin-bottom: 30px;">
        <?php
            $db = new mysqli('localhost', 'root', '', 'csrf');

            if($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

            $result = $db->query("SELECT userId,username FROM users");
            while($row = $result->fetch_assoc()){
                echo "<span style='font-size: 20px'>".$row['username'] . "</span><form method='get' role='form' action='borrar_usuario.php' style='display: inline'><input type='hidden' name='usuario' value='".$row['userId']."'>
                                        <input type='submit' value='Eliminar'></form><br>";
            }

            $db->close();
        ?>
    </div>
    <h4>Numero de archivos subidos: 123</h4>
    <h4>Puntos obtenidos: 1666</h4>
    <h4>Horas dedicadas a este sitio: 533</h4>
<?php endif; ?>
</div>
</body>
</html>