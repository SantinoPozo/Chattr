<?php
include(__DIR__ . '/../_layouts/layout.php');
?>
<div id="contenido-principal" class="col p-2 order-1">
    <div>
        
    </div>
</div>
<script type="text/javascript">
    async function obtenerPosts(){
        let respuesta = await fetch("/src/controllers/posts/index.php?id="<?php echo $_GET['id'];?>);
        let listadoPosts = await respuesta.json();
        return listadoPosts;
    }
</script>