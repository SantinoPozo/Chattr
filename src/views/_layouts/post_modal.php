<div class="modal fade" id="subirPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subirPostLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="subirPostLabel">Subir un post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= '/src/controllers/posts/store.php' ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-1 p-0">
                                <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle" width="40px" alt="Avatar">
                            </div>
                            <div class="col">
                                <textarea
                            class="form-control"
                            name="content"
                            rows="5"
                            placeholder="¿Cómo te sientes hoy?"></textarea>
                            </div>
                            <input type="hidden" name="url" value="<?= $_SERVER['REQUEST_URI'] ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>
