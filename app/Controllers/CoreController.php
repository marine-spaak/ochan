<?php

namespace App\Controllers;

class CoreController
{
  protected $router;
  protected $match;

  // On définit un constructeur a CoreController dont hériterons tout ses enfants
  public function __construct($router, $match)
  {
    // Je stocke les paramètres reçus dans des propriétés protected
    // ainsi tout les autres Controller qui héritent de CoreController
    // hériteront également de ces deux propriétés, adieu global !
    $this->router = $router;
    $this->match  = $match;

    // ACL - Acces Control List
    $acl = [
      // On ne met pas les routes "publiques" comme le login
      // en gros, si la route n'est pas listée ici, on ne controle pas qui ya accède

      // TODO compléter ici
      // "category-list"            => ['admin', 'catalog-manager'],
    ];

    // Vérifier si la route actuelle est une clé du tableau ACL (et si une route existe)
    // Si oui, c'est une route à accès controlé
    if ($this->match && array_key_exists($this->match['name'], $acl)) {
      $authorizedRoles = $acl[$this->match['name']];
      $this->checkAuthorization($authorizedRoles);
    }
    // Sinon, ce n'est pas une route contrôle : on affiche normalement 
  }

  protected function show(string $viewName, $viewData = [])
  {
    global $router;

    $viewData['currentPage'] = $viewName;
    $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
    $viewData['baseUri'] = $_SERVER['BASE_URI'];

    extract($viewData);

    require_once __DIR__ . '/../views/layout/header.tpl.php';
    require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
    require_once __DIR__ . '/../views/layout/footer.tpl.php';
  }

  protected function checkAuthorization($authorizedRoles = [])
  {
    if (isset($_SESSION['userId'])) {
      $user = $_SESSION['userObject'];

      $role = $user->getRole();

      if (in_array($role, $authorizedRoles)) {
        return true;
      } else {
        http_response_code(403);
        echo '403';
        exit();
      }
    } else {
      header('Location : /user/login');
      exit();
    }
  }
}
