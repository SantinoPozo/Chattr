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
    require_once(__DIR__ . '/../_layouts/post_base.php');
    include(__DIR__ . '/../_layouts/comment_modal.php');
    ?>
  </div>
</div>
<script type="text/javascript">
  var userActual = <?= json_encode($_SESSION['user']);?>
</script>
<script src="/assets/js/mostrarPost.js"></script>
<script type="text/javascript">
  mostrarPosts('/src/controllers/posts/index.php?id='+ userActual.id);
</script>