<?php if (! empty($article->errors)): ?>
<ul>
  <?php foreach ($article->errors as $error): ?>
  <li><?= $error ?></li>
  <?php endforeach ?>
</ul>
<?php endif;  ?>

<?php 
 
  $prePage =$_SERVER['HTTP_REFERER'];
  // var_dump($prePage);
 ?>

<div class="row">
  <div class="offset-md-1 col-md-10 offset-md-1">
    <form method="post" id="formArticle">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Article title" autocomplete="off"
          value="<?= htmlspecialchars($article->title) ?>">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" name="content" rows="4" cols="40" id="content" placeholder="Article content"
          rows="3"><?= htmlspecialchars($article->content) ?></textarea>
      </div>

      <div class="mb-3">
        <label for="published_at" class="form-label">Published Date</label>
        <input type="text" class="form-control" name="published_at" id="published_at" placeholder="Published Date"
          autocomplete="off" value="<?= htmlspecialchars($article->published_at) ?>">
      </div>

      <fieldset>
        <legend>Categories</legend>

        <?php foreach ($categories as $category) : ?>
        <div>
          <input type="checkbox" name="category[]" value="<?= $category['id'] ?>" id="category<?= $category['id'] ?>"
            <?php if (in_array($category['id'], $category_ids)) :?>checked<?php endif; ?>>
          <label for="category<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
        </div>
        <?php endforeach; ?>
      </fieldset>

      <button class="btn mt-3 mx-2 add_article_btn">save</button>

    </form>
    <a href="<?= $prePage ?>"><button class="btn mt-3">Back to Previous</button></a>
  </div>
</div>