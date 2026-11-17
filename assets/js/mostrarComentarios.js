async function obtenerComentarios(postId){
          let respuesta = await fetch('/src/controllers/comments/index.php?id=' + userActual.id + '&post=' + postId);
          console.log(postId);
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
async function mostrarComentarios(postId){
    let contenedor = document.querySelector('#contenido-principal');
    let listadoComentarios = await obtenerComentarios(postId);

    if(listadoComentarios.length !== 0){
        let fechaActual = new Date().getTime();
        listadoComentarios.forEach(comment => {
            let nuevoCom = contenedor.querySelector('#comentario-base').cloneNode(true);
            nuevoCom.removeAttribute('id');

            nuevoCom.querySelector('a.comentario-link').setAttribute('href','/src/views/posts/show.php?id=' + comment.user_id);
            
            nuevoCom.querySelector('img').setAttribute('src','/assets/img/users/' + comment.user_pfp);
            
            nuevoCom.querySelector('span.username').textContent = comment.user_name;
            
            let fechaPost = new Date(comment.created_at).getTime();
            let tiempo = obtenerFecha(fechaActual, fechaPost);

            nuevoCom.querySelector('span.time').textContent = tiempo;

        nuevoCom.querySelector('p.card-text').textContent = comment.content;

        nuevoCom.querySelector('div.botones').setAttribute('data-post-id', comment.id);
        postBotonCom = nuevoCom.querySelector('button.btn-comentar');
        
        postBotonCom.querySelector('.contador').textContent = comment.cantComments;

        postBotonLike = nuevoCom.querySelector('button.btn-like');
        

        if(comment.liked === "TRUE"){
          postBotonLike.querySelector('.heart-empty').classList.toggle("d-none");
          postBotonLike.querySelector('.heart-filled').classList.toggle("d-none");
        }
        postBotonLike.querySelector('.contador').textContent = comment.cantLikes;

            contenedor.append(nuevoCom);
        });
    } else {
    document.createElement('p');
    sinPosts = "No hay posts todavia.";
    }
    contenedor.querySelector('#comentario-base').remove();
}