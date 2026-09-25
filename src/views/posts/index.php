<?php
include(__DIR__ . '/../_layouts/layout.php');
?>
  <div class="btn-group d-flex mb-2" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-dark active">Para tí</button>
    <button type="button" class="btn btn-dark">Los que sigues</button>
    <button type="button" class="btn btn-dark">Right</button>
  </div>
  <?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
      <div class="container mb-3">
        <div class="row">
          <div class="col p-0">
            <img src="<?= '/assets/img/users/default.png' ?>" class="rounded-circle w-100" alt="Avatar">
          </div>
          <div class="col-11">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?= $post['user_name'] ?></h5>
                <p class="card-text"><?= $post['content'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No hay posts todavía.</p>
  <?php endif; ?>
</div>