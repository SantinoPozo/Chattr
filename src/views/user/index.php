<?php
include(__DIR__ . '/../_layouts/layout.php');
?>
<div id="contenido-principal" class="col p-2 order-1">
    <div class="mb-4 usuario" id="usuario-base">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <img src="<?= '/assets/img/users/default.png' ?>" class="rounded-circle" width="96px" alt="Avatar">
                </div>
                <h5 class="card-title">
                    <div class="username text-center fs-3">Usuario</div>
                </h5>
                <div id="contadores" class="text-center">
                  <a href="" class="text-decoration-none">
                    <span id="cont-seguidores" class="fw-bold">X</span>
                    <span>Seguidores</span>
                  </a>
                  <a href="" class="text-decoration-none">
                    <span id="cont-siguiendo" class="fw-bold">X</span>
                    <span>Siguiendo</span>
                  </a>
                </div>
                <p class="card-text text-center">Descripcion</p>
                <div class="d-flex justify-content-center">
                    <button class="btn-seguir btn btn-primary btn-floating">
                        <span id="seguir">Seguir</span>
                    </button>
                    <button type="button" class="btn btn-primary w-100 fs-5" data-bs-toggle="modal" data-bs-target="#editarUsuario">
                      <span>Editar</span>
                    </button>
                    <?php include(__DIR__ . '/../_layouts/user_modal.php');?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include(__DIR__ . '/../_layouts/post_base.php');
    ?>
</div>
<script type="text/javascript">
    async function obtenerUsuario(){
        try {
        let respuesta = await fetch("/src/controllers/user/index.php?id=<?= $_GET['id']?>&currentUser=<?= $_SESSION['user']['id']?>");

        let userDatos = await respuesta.json();
        return userDatos;    
        } catch (error) {
            console.log(error);
        }
        
    }
    async function mostrarUsuario(){
        let userDatos = await obtenerUsuario();
        let contenedor = document.querySelector('#contenido-principal');
        if(userDatos){
            user = userDatos.id;
            let usuario = contenedor.querySelector('#usuario-base');
            usuario.removeAttribute('id');

            usuario.querySelector('img').setAttribute('src','/assets/img/users/' + userDatos.profile_picture);

            usuario.querySelector('div.username').textContent = userDatos.name;

            userContadorSeguir = usuario.querySelector('#contadores');

            userContadorSeguir.querySelector('#cont-seguidores').textContent = userDatos.cantSeguidores;
            userContadorSeguir.querySelector('#cont-siguiendo').textContent = userDatos.cantSiguiendo;

            usuario.querySelector('p.card-text').textContent = userDatos.description;

            if(userDatos.id === <?= json_encode($_SESSION['user']['id'])?>){
              usuario.querySelector('#seguir').textContent = "Editar";
              usuario.querySelector('p.card-text').replaceWith('span')

            } else if(userDatos.siguiendo === "TRUE"){
              usuario.querySelector('#seguir').textContent = "Siguiendo";
              usuario.querySelector('.heart-filled').classList.toggle("d-none");
            }
            
        }
    }

    $(document).ready(function(){
    console.log("Funcionando");
    $(document).on("click", ".post .like-btn", function(){
      userId = <?= json_encode($_SESSION['user']['id']);?>;
      postId = $(this).attr('data-post-id');

      element = this;
      $.ajax({
        type: "POST",
        url: "./../../controllers/posts/like.php",
        data: {
          user_id: userId,
          post_id: postId
        },
        dataType: "json",
        success: function (response) {
          $("span.heart-empty", element).toggleClass("d-none");
          $("span.heart-filled", element).toggleClass("d-none");
        },
        error: function (ts){
          console.log(ts.responseText);
        }
      });
    });
    $(document).on("click", ".usuario .btn-seguir", function(){
      seguidor = <?= json_encode($_SESSION['user']['id']);?>;
      seguido = <?= json_encode($_GET['id'])?>;

      element = this;
      $.ajax({
        type: "POST",
        url: "./../../controllers/user/seguir.php",
        data: {
          follower_id: seguidor,
          followed_id: seguido
        },
        dataType: "json",
        success: function (response) {
            if($("span.seguir", element).text() === "Seguir"){
                $("span.seguir", element).text("Siguiendo");
            } else {
                $("span.seguir", element).text("Seguir");
            }
        },
        error: function (ts){
          console.log(ts.responseText);
        }
      });
    });
  });

  async function obtenerPosts(){
    let respuesta = await fetch('/src/controllers/user/posts.php?id=<?= $_GET['id']?>&currentUser=<?= $_SESSION['user']['id']?>');
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
      console.log("si");
      tiempo = Math.floor(fechaDiferencia / 60) + "m";
    } else {
      tiempo = fechaDiferencia + "s";
    }
    return tiempo;
  }
  async function mostrarPosts(){
    let listadoPosts = await obtenerPosts();
    let contenedor = document.querySelector('#contenido-principal');
    if(listadoPosts.length !== 0){
      let fechaActual = new Date().getTime();
      listadoPosts.forEach(post => {
        let nuevoPost = contenedor.querySelector('#post-base').cloneNode(true);
        nuevoPost.removeAttribute('id');

        nuevoPost.querySelector('a').setAttribute('href','/src/views/user/index.php?id=' + post.user_id);

        nuevoPost.querySelector('img').setAttribute('src','/assets/img/users/' + post.user_pfp);

        nuevoPost.querySelector('span.username').textContent = post.user_name;

        let fechaPost = new Date(post.created_at).getTime();
        let tiempo = obtenerFecha(fechaActual, fechaPost);

        nuevoPost.querySelector('span.time').textContent = tiempo;

        nuevoPost.querySelector('p.card-text').textContent = post.content;
        
        postBotonLike = nuevoPost.querySelector('button.like-btn');
        postBotonLike.setAttribute('data-post-id', post.id);

        if(post.liked === "TRUE"){
          postBotonLike.querySelector('.heart-empty').classList.toggle("d-none");
          postBotonLike.querySelector('.heart-filled').classList.toggle("d-none");
        }
        postBotonLike.querySelector('.contador').textContent = post.cantLikes;

        contenedor.append(nuevoPost);
      });
    } else {
      document.createElement('p');
      sinPosts = "No hay posts todavia.";
      contenedor.append(sinPosts);
    }
    contenedor.querySelector('#post-base').remove();
    console.log(listadoPosts);
  }

    mostrarUsuario();
    mostrarPosts();
</script>