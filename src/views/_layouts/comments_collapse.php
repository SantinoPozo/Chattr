<div class="collapse" id="comentarios">
    <div class="card card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1 p-0 d-flex justify-content-center">
                    <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle" width="32px" height="32px" alt="Avatar">
                </div>
                <div class="col">
                    <input type="text" class="form-control">
                </div>
            </div>
            <hr>
            <div class="row comment" id="comentario-base">
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
<script type="text/javascript">
    function cargarComentarios(){
        async function obtenerComentarios(postId){
            let respuesta = await fetch('/src/controllers/comments/index.php?id=<?= $_SESSION['user']['id']?>&post=' + postId);
            let listadoPosts = await respuesta.json();
            return listadoPosts;
        }
        function obtenerFecha(fechaActual, fechaPost){
            let fechaDiferencia = Math.floor((fechaActual - fechaPost)/1000);
            let tiempo = "";
            if (fechaDiferencia > 86399){
                tiempo = new Date(fechaPost).toLocaleDateString();
            } else if (fechaDiferencia > 3599){
                tiempo = Math.floor(fechaDiferencia / 3600) + "h";
            } else if (fechaDiferencia > 59){
                tiempo = Math.floor(fechaDiferencia / 60) + "m";
            } else {
                tiempo = fechaDiferencia + "s";
            }
            return tiempo;
        }
        async function mostrarComentarios(){
            let contenedor = document.querySelector('#contenido-principal');
            let postId = contenedor.querySelector('').getAttribute('data-post-id');
            let listadoComentarios = await obtenerComentarios(postId);
            
            if(listadoComentarios.length !== 0){
                let fechaActual = new Date().getTime();
                listadoComentarios.forEach(comment => {
                    let nuevoCom = contenedor.querySelector('#comentario-base').cloneNode(true);
                    nuevoCom.removeAttribute('id');

                    nuevoCom.querySelector('a.username').setAttribute('href','/src/views/user/index.php?id=' + comment.user_id);
                    
                    nuevoCom.querySelector('img').setAttribute('src','/assets/img/users/' + comment.user_pfp);
                    
                    nuevoCom.querySelector('span.username').textContent = comment.user_name;
                    
                    let fechaPost = new Date(comment.created_at).getTime();
                    let tiempo = obtenerFecha(fechaActual, fechaPost);

                    nuevoCom.querySelector('span.time').textContent = tiempo;

                    /*nuevoCom.querySelector('p.card-text').textContent = comment.content;
                    postBotonCom = nuevoCom.querySelector('button.btn-comentar');
                    postBotonCom.setAttribute('data-bs-target', "#"+post.id);
                    nuevoCom.querySelector('.collapse').setAttribute('id', comment.id);

                    postBotonLike = nuevoCom.querySelector('button.btn-like');
                    postBotonLike.setAttribute('data-post-id', comment.id);*/

                    /*if(comment.liked === "TRUE"){
                    postBotonLike.querySelector('.heart-empty').classList.toggle("d-none");
                    postBotonLike.querySelector('.heart-filled').classList.toggle("d-none");
                    }
                    postBotonLike.querySelector('.contador').textContent = post.cantLikes;
*/
                    contenedor.append(nuevoCom);
                });
            } else {
            document.createElement('p');
            sinPosts = "No hay posts todavia.";
            contenedor.append(sinPosts);
            }
            contenedor.querySelector('#post-base').remove();
        }
    }
    
</script>