<?php

namespace App\Controllers;

// TODO faire le "use" des models dont j'ai besoin

class MainController extends CoreController
{
  public function home()
  {
    // TODO utiliser les modèles pour aller chercher les findAll dont on pourrait avoir besoin

    // TODO compléter le viewData avec les données collectées
    $this->show('main/home', []);
  }
}
