<?php
include(__DIR__ . '/../_layouts/layout.php');
?>
<div id="contenido-principal" class="col p-2 order-1">
  <div class="container">
    <?php
    require_once(__DIR__ . '/../_layouts/post_base.php');
    require_once(__DIR__ . '/../_layouts/comentario_base.php');
    include(__DIR__ . '/../_layouts/comment_modal.php');
    ?>
  </div>
</div>
<script type="text/javascript">
  var userActual = <?= json_encode($_SESSION['user']);?>;
  var postPagina = <?= json_encode($_GET['id'])?>;
</script>
<script src="/assets/js/mostrarPost.js"></script>
<script src="/assets/js/mostrarComentarios.js"></script>
<script type="text/javascript">
  mostrarPosts('/src/controllers/posts/show.php?post='+ postPagina +'&id='+ userActual.id);
  mostrarComentarios(postPagina);
</script>