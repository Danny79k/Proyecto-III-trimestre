<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Document</title>
</head>

<body>
    <?php
    $conn = new mysqli('localhost', 'root', '7997', 'social');
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
    if (isset($_GET["confirmacion"]) && $_GET["confirmacion"] == "si") {
        $consultaBorrado1 = "delete from publicaciones where id_usuario=" . $_GET['user_id'];
        $consultaBorrado2 = "delete from pertenecer_grupo where id_usuario=" . $_GET['user_id'];
        $consultaBorrado3 = "delete from grupos where id_usuario_premium=" . $_GET['user_id'];
        $consultaBorrado4 = "delete from perfil where id_usuario=" . $_GET['user_id'];
        $consultaBorrado5 = "delete from usuario_normal where id_usuario_normal=" . $_GET['user_id'];
        $consultaBorrado6 = "delete from usuario_premium where id_usuario_premium=" . $_GET['user_id'];
        $consultaBorrado7 = "delete from usuario where id=" . $_GET['user_id'];
        $conn->query($consultaBorrado1);
        $conn->query($consultaBorrado2);
        $conn->query($consultaBorrado3);
        $conn->query($consultaBorrado4);
        $conn->query($consultaBorrado5);
        $conn->query($consultaBorrado6);
        $conn->query($consultaBorrado7);
        if ($_SESSION["usuario"] != "admin") {
            header("location:login.php?msn=1");
            session_unset();
        } else {
            header("location:crud_admin.php");
            exit();
        }
    }
    ?>

    <h1 class="display-5 text-center text-light bg-dark m-0">Estas seguro que quieres elimina el usuario! <strong>esta
            accion es irreversible</strong></h1>
    <div class="d-flex bg-dark justify-content-center p-3 largo">
        <div class="col-4 p-5>
            <p class=" text-center fs-4 text-light ">quieres borrar?</p>
            <div class=" d-flex justify-content-around text-light ">
                <a href=" delete_user.php?confirmacion=si&user_id=<?php echo $_GET['user_id'] ?>"
            class="shadow-lg text-light btn btn-danger col-5 p-3">Si</a>
            <a href="<?php echo ($_SESSION["usuario"] != "admin") ? 'perfil.php' : 'crud_admin.php' ?>"
                class="shadow-lg text-light btn col-5 p-3 border">No</a>
        </div>
    </div>
    </div>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>