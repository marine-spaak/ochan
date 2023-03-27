<div class="container my-4">
  <a href="<?= $router->generate('product-list') ?>" class="btn btn-success float-end">Retour</a>
  <h2>Ajouter un produit</h2>

  <form action="" method="POST" class="mt-5">
    <div class="mb-3">
      <label for="name" class="form-label">Nom</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Nom du produit" value="<?=$product->getName()?>" required>
    </div>
    <div class="mb-3">
      <label for="descrition" class="form-label">Description</label>
      <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?=$product->getDescription()?>" aria-describedby="subtitleHelpBlock" required>
      <small id="subtitleHelpBlock" class="form-text text-muted">
        Sera affiché sur la page d'accueil comme bouton devant l'image
      </small>
    </div>
    <div class="mb-3">
      <label for="picture" class="form-label">Image</label>
      <input type="text" class="form-control" id="picture" name="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?=$product->getPicture()?>" required>
      <small id="pictureHelpBlock" class="form-text text-muted">
        URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
      </small>
    </div>
    <div class="mb-3">
      <label for="class_id" class="form-label">Classe</label>
      <select name="class_id" id="class_id" class="form-control" required>
        <?php foreach ($classes as $class) : ?>
          <option value="<?= $class->getId() ?>" <?= $class->getId() == $product->getClassId() +1 ? 'selected' : '' ?> ><?= $class->getName() ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary mt-5">Valider</button>
    </div>
  </form>
</div>