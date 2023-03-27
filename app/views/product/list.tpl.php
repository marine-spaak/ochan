<?php
// dump($viewData);
?>

<a href="<?= $router->generate('product-add-access') ?>" class="btn btn-success float-end">Ajouter</a>

<h1>Liste des produits</h1>

<div class="products-cards-container mt-4 catalogue d-flex flex-wrap justify-content-around">

  <?php foreach ($products as $product) : ?>

    <div class="card m-2 p-3 product-card" style="width: 18rem;">
      <img class="card-img-top" src="<?= $assetsBaseUri ?><?= $product->getPicture() ?>" alt="image d'un produit">
      <div class="card-body text-center">
        <?= $product->getId() ?> <?= $product->getName() ?>
      </div>
      <a href="<?= $router->generate('product-update-access') ?>" class="btn btn-sm btn-warning mb-2">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
      </a>
      <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
      </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= $router->generate('product-delete', ['id' => $product->getId()]) ?>">Oui, je veux supprimer</a>
          <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
        </div>
    </div>

  <?php endforeach; ?>

</div>

<a href="<?= $router->generate('home') ?>">
  <h2> Retour à l'accueil </h2>
</a>