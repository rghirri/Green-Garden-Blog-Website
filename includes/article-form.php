<?php if (! empty($errors)): ?>
<ul>
  <?php foreach ($errors as $error): ?>
  <li><?= $error ?></li>
  <?php endforeach ?>
</ul>
<?php endif;  ?>

<div class="row">
  <div class="col-md-10 offset-md-1">
    <form method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Article title" autocomplete="off"
          value="<?= htmlspecialchars($title) ?>">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" name="content" rows="4" cols="40" id="content" placeholder="Article content"
          rows="3"><?= htmlspecialchars($content) ?></textarea>
      </div>

      <div class="mb-3">
        <label for="published_at" class="form-label">Published Date</label>
        <input type="text" class="form-control" name="published_at" id="published_at" placeholder="Published Date"
          autocomplete="off" value="<?= htmlspecialchars($published_at) ?>">
      </div>

      <button class="btn mt-3 add_article_btn">save</button>

    </form>
  </div>
</div>