<script>
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
</script>