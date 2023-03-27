<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\ProductClass;
use App\Models\Type;

class ProductController extends CoreController
{

  // 📜🍅 Méthode pour lister
  public function list()
  {
    $products = Product::findAll();
    $types = Type::findAll();
    $classes = ProductClass::findAll();
    $this->show('product/list', ['products' => $products, 'classes' => $classes, 'types' => $types]);
  }

  // ➕🍅 Méthode pour ajouter
  public function productAddAccess()
  {
    $classes = ProductClass::findAll();
    $this->show('product/add', ['classes' => $classes]);
  }

  public function productAddProcess()
  {
    if (!empty($_POST)) {

      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
      $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS);
      $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);

      $errorList = [];

      if (empty($name)) {
        $errorList[] = 'Merci de renseigner le nom du produit';
      }

      if ($name === false) {
        $errorList[] = 'Merci de renseigner un nom valide';
      }

      if (empty($description)) {
        $errorList[] = 'Merci de renseigner la description du produit';
      }

      if ($description === false) {
        $errorList[] = 'Merci de renseigner une description valide';
      }

      if (empty($picture)) {
        $errorList[] = 'Merci de renseigner l\'image du produit';
      }

      if ($picture === false) {
        $errorList[] = 'Merci de renseigner une image valide';
      }

      if (empty($class_id)) {
        $errorList[] = 'Merci de renseigner la catégorie du produit';
      }

      // Pas nécessaire car on affiche les catégories via un select dans le form
      if ($class_id === false) {
        $errorList[] = 'Merci de renseigner une catégorie valide';
      }

      if (empty($errorList)) {
        $modelProduct = new Product();

        $modelProduct->setName($name);
        $modelProduct->setDescription($description);
        $modelProduct->setPicture($picture);
        $modelProduct->setClassId($class_id);

        // TODO 
        $isInsert = $modelProduct->insert();
        // $isInsert contient un booléen (true / false)

        // Si l'insertion est OK => redirection vers la liste
        if ($isInsert) {    // $isInsert vaut true
          header('Location: /product-list');
        } else {
          // Sinon => message d'erreur et redirection vers le form (pas besoin ici car notre attribut action du form est vide, et donc on reste sur la page)
          $errorList[] = 'La création du produit a échoué';
        }
      } else {
        // Ici, on a au moins une erreur
        // On reste sur le formulaire et on souhaite transmettre à show() les champs saisis et les erreurs obtenues
        // Pour que plus tard, le template récupère ces données pour :
        // - pré-remplir les input du form avec les données qui ont été saisies
        // - afficher les erreurs

        // 1. On instancie un model Catégory
        $modelProduct = new Product();

        // 2. On sette les propriétés de Category
        $modelProduct->setName($name);
        $modelProduct->setDescription($description);
        $modelProduct->setPicture($picture);
        $modelProduct->setClassId($class_id);

        // 3. On appelle la méthode show() en lui passanrt les données (cad valeurs des champs + erreur(s))
        // Dans le template category-add, on récupère $viewData['category'] et $viewData['errors']
        // et via extract() : $category et $errors
        $this->show('product/product-add', [
          'product' => $modelProduct,
          'errors' => $errorList
        ]);

        // TODO : utiliser les données dans le template pour gérer l'affichage
      }
    }
  }


  // 📝🍅 Méthode pour modifier
  public function productUpdateAccess()
  {
    $classes = ProductClass::findAll();
    $this->show('product/update', ['classes' => $classes]);
  }


  public function delete($id= null)
  {
    if (Product::delete($id)) {
      header('Location: /product-list');
    } else {
      echo "Erreur dans la suppression du produit";
    }
  }
}
