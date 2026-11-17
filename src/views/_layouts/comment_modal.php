<div class="modal fade" id="subirComentario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subirComentarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="subirPostLabel">Responder</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= '/src/controllers/comments/store.php' ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-1 p-0">
                                <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle" width="40px" alt="Avatar">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h6>
                                            <a class="username text-decoration-none" href="#">
                                                <span class="username text-black">
                                                    Username
                                                </span>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="comment-content">
                                            Comment
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-1 p-0">
                                <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle" width="40px" alt="Avatar">
                            </div>
                            <div class="col">
                                <textarea
                            class="form-control"
                            name="content"
                            rows="5"
                            placeholder="Escribe tu respuesta"></textarea>
                            </div>
                            <input type="hidden" id="input-post" name="post" value="">
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
