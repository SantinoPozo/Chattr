<?php
include(__DIR__ . '/../_layouts/layout.php');
?>
<div id="contenido-principal" class="col p-2 order-1">
  <div class="btn-group d-flex mb-2" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-dark active">Para tí</button>
    <button type="button" class="btn btn-dark">Los que sigues</button>
    <button type="button" class="btn btn-dark">Right</button>
  </div>
  <div class="container">
    <?php
    include(__DIR__ . '/../_layouts/post_base.php');
    ?>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    console.log("Funcionando");
    $(document).on("click", ".post .btn-like", function(){
      userId = <?= json_encode($_SESSION['user']['id']);?>;
      postId = $(this).parent().attr('data-post-id');

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

  });
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
  async function obtenerPosts(){
    let respuesta = await fetch('/src/controllers/posts/index.php?id=<?= $_SESSION['user']['id']?>');
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

        nuevoPost.querySelector('a.username').setAttribute('href','/src/views/user/index.php?id=' + post.user_id);
        
        nuevoPost.querySelector('img').setAttribute('src','/assets/img/users/' + post.user_pfp);
        
        nuevoPost.querySelector('span.username').textContent = post.user_name;
        
        let fechaPost = new Date(post.created_at).getTime();
        let tiempo = obtenerFecha(fechaActual, fechaPost);

        nuevoPost.querySelector('span.time').textContent = tiempo;

        nuevoPost.querySelector('p.card-text').textContent = post.content;

        nuevoPost.querySelector('div.botones').setAttribute('data-post-id', post.id);
        postBotonCom = nuevoPost.querySelector('button.btn-comentar');
        postBotonCom.setAttribute('data-bs-target', "#"+post.id);
        nuevoPost.querySelector('.collapse').setAttribute('id', post.id);

        postBotonLike = nuevoPost.querySelector('button.btn-like');
        

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
  }
  mostrarPosts();


</script>