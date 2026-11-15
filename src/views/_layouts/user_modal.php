<div class="modal fade" id="editarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editarUsuarioLabel">Editar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= '/src/controllers/posts/store.php' ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle" width="80" alt="Avatar"> 
                        <div>
                            <label for="nombre" class="form-label">Nombre de usuario</label>
                            <input type="text" id="nombre" class="form-control" name="name" placeholder="Nombre de Usuario">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea
                            class="form-control"
                            id="descripcion"
                            name="description"
                            rows="5"
                            placeholder="Contenido"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
