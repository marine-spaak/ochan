<?php

// ==================================
// 0️⃣ Requires et base_URI
// ==================================

#Region

  // Je n'oublie pas le require pour l'autoload

  require_once '../vendor/autoload.php';

  // Je n'oublie pas de démarrer la session

  session_start();

  // Je rajoute les "use" pour les controllers
  // TODO 

  use App\Controllers\MainController;
  use App\Controllers\ProductController;

  // J'instancie la classe AltoRouter
  $router = new AltoRouter();

  // J'utilise setBasePath
  // pour définir le chemin absolu d'où partiront toutes mes routes (avec :8080, on a deux cas)
  if (array_key_exists('BASE_URI', $_SERVER)) {
      $router->setBasePath($_SERVER['BASE_URI']);
  } else {
      $_SERVER['BASE_URI'] = '/';
  }
#End Region

// ==================================
// 🛣️ Création des routes (avec map)
// ==================================

#Region

  // 🏠 MAIN - home
  // ==============
  $router->map("GET", "/", ['method' => 'home', 'controller' => MainController::class], 'home');

  // 🍅 PRODUCT
  // ==============
  // 📜🍅 Liste
  $router->map("GET", "/product-list", ['method' => 'list', 'controller' => ProductController::class], 'product-list');

  // ➕🍅 Ajout
  $router->map("GET", "/product-add", ['method' => 'productAddAccess', 'controller' => ProductController::class], 'product-add-access');
  $router->map("POST", "/product-add", ['method' => 'productAddProcess', 'controller' => ProductController::class], 'product-add-process');

  // ❌🍅 Delete
  $router->map("GET", "/product-delete/[i:id]", ['method' => 'delete', 'controller' => ProductController::class], 'product-delete');

  // 📝🍅 Update
  $router->map("GET", "/product-update/[i:id]", ['method' => 'productUpdateAccess', 'controller' => ProductController::class], 'product-update-access');
  $router->map("POST", "/product-update/[i:id]", ['method' => 'productUpdateProcess', 'controller' => ProductController::class], 'product-update-process');

#End Region

// ==================================
// 🚦 Dispatcher
// ==================================

#Region

  $match = $router->match();
  $dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::error404');

  // Cette fonction permet d'envoyer des arguments au constructeur du Controller utilisé
  $dispatcher->setControllersArguments( $router, $match );

  $dispatcher->dispatch();

#End Region
