<?php
/* Connect To Database*/
require_once("../conexion.php");


$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $where = "";

    if ($_REQUEST['query'] != "") {
        $where = "  WHERE `name` LIKE '%" . $_REQUEST['query'] . "%'";
    }

    $query = mysqli_query($con, "SELECT * FROM  person" . $where);

    if ($query) {

        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class='text-center'>Nombre</th>
                    <th>Apellido</th>
                    <th>Ciudad</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $finales = 0;
                while ($row = mysqli_fetch_array($query)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $lastname = $row['lastname'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                    $email = $row['email'];
                    ?>
                    <tr class="">
                        <td><?php echo $name; ?></td>
                        <td><?php echo $lastname; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td>
                            <a href="#" data-target="#editProductModal" class="edit" data-toggle="modal"
                               data-id='<?php echo $id; ?>' data-name="<?php echo $name ?>"
                               data-lastname="<?php echo $lastname ?>" data-address="<?php echo $address ?>"
                               data-phone="<?php echo $phone; ?>" data-email="<?php echo $email; ?>"><i
                                        class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                            <a href="#deleteProductModal" class="delete" data-toggle="modal"
                               data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip"
                                                               title="Eliminar">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>


        <?php
    }
}
?>   