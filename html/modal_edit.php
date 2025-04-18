<div id="editProductModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="edit_product" id="edit_product">
                <div class="modal-header">
                    <h4 class="modal-title">Editar registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="edit_name" id="edit_name" class="form-control" required>

                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="edit_lastname" id="edit_lastname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" name="edit_address" id="edit_address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" name="edit_phone" id="edit_phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="email" name="edit_email" id="edit_email" class="form-control" required>
                    </div>
                </div>
                <input type="hidden" name="edit_id" id="edit_id" class="form-control" required>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-info" value="Guardar datos">
                </div>
            </form>
        </div>
    </div>
</div>