<?php
if (empty($_POST['name'])) {
    $errors[] = "Ingresa el nombre dEl tercero.";
} elseif (!empty($_POST['name'])) {
    require_once("../conexion.php");//Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code
    $name = mysqli_real_escape_string($con, (strip_tags($_POST["name"], ENT_QUOTES)));
    $lastname = mysqli_real_escape_string($con, (strip_tags($_POST["lastname"], ENT_QUOTES)));
    $address = mysqli_real_escape_string($con, (strip_tags($_POST["address"], ENT_QUOTES)));
    $phone = mysqli_real_escape_string($con, (strip_tags($_POST["phone"], ENT_QUOTES)));
    $email = mysqli_real_escape_string($con, (strip_tags($_POST["email"], ENT_QUOTES)));


    // REGISTER data into database
    $sql = "INSERT INTO `person` (`id`, `name`, `lastname`, `address`, `phone`, `email`, `created_at`) 
VALUES (NULL, '" . $name . "', '" . $lastname . "', '" . $address . "', '" . $phone . "', '" . $email . "', CURRENT_TIME())";
    $query = mysqli_query($con, $sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "Registro guardado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }

} else {
    $errors[] = "desconocido.";
}
if (isset($errors)) {

    ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
    <?php
}
if (isset($messages)) {

    ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
    <?php
}
?>