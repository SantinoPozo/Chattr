<div class="collapse" id="comentarios">
    <div class="card card-body">
        <div class="container-fluid">
            <form>
            <div class="row">
                
                <div class="col-1 p-0 d-flex justify-content-center">
                    <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle" width="32px" height="32px" alt="Avatar">
                </div>
                
                <div class="col">
                    <input type="text" class="form-control" name="content">
                </div>
                <div class="col-1 p-0">
                    <button type="submit" class="btn link-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                        </svg>
                    </button>
                </div>
                
            </div>
            </form>
            <hr>
            <div class="row comment d-none" id="comentario-base">
                <div class="col-1 p-0 d-flex justify-content-center">
                    <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle" width="32px" height="32px" alt="Avatar">
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
                    <div class="row">
                        <div class="col">
                            Buttons go here
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
