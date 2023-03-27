<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Product extends CoreModel
{
  // ==============
  // 💲 Propriétés
  // ==============

  #Region

  private $name;
  private $class_id;
  private $picture;
  private $description;
  private $type;

  #End Region

  // =============================================================
  // 👻👶🏽 Méthodes abstraites qui deviennent réelles (coté fille)
  // =============================================================

  #Region
  // ➕ INSERT
  public function insert()
  {
    $pdo = Database::getPDO();
    $sql = '
        INSERT INTO `product`
        (`name`, `description`, `picture`, `class_id`)
        VALUES (:name, :description, :picture, :class_id)
    ';

    $query = $pdo->prepare($sql);
    $query->execute([
      ':name' => $this->name,
      ':description' => $this->description,
      ':picture' => $this->picture,
      ':class_id' => $this->class_id,
    ]);

    if ($query->rowCount() > 0) {
      // Alors on récupère l'id auto-incrémenté généré par MySQL
      $this->id = $pdo->lastInsertId();

      // On retourne VRAI car l'ajout a parfaitement fonctionné
      return true;
    }
    return false;
  }

  // 🔍 FIND et FINDALL
  public static function find($id)
  {
    $pdo = Database::getPDO();
    $sql = 'SELECT * FROM `product` WHERE `id` =' . $id;
    $pdoStatement = $pdo->query($sql);
    $results = $pdoStatement->fetchObject('App\Models\Product');

    return $results;
  }

  public static function findAll()
  {
    $pdo = Database::getPDO();
    $sql = 'SELECT * FROM `product`';
    $pdoStatement = $pdo->query($sql);
    $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

    return $results;
  }

  // 📝 UPDATE
  public function update($id)
  {
    $pdo = Database::getPDO();

    $sql = "
        UPDATE `product`
        SET
        name = :name,
        description = :description,
        picture = :picture,
        class_id = :class_id
        WHERE id = :id
    ";

    $pdoStatement = $pdo->prepare($sql);

    $pdoStatement->bindValue(':name', $this->name);
    $pdoStatement->bindValue(':description', $this->description);
    $pdoStatement->bindValue(':picture', $this->picture);
    $pdoStatement->bindValue(':class_id', $this->class_id);

    $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

    $pdoStatement->execute();

    return ($pdoStatement->rowCount() > 0);
  }

  // ❌ DELETE
  public static function delete($id)
  {
    // se connecter à la BDD
    $pdo = Database::getPDO();

    // écrire notre requête
    $sql = "DELETE FROM `product` WHERE `id` =" . $id;

    // On prépare puis on exécute la requete
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute();

    // Avec cette écriture synthétique, il renvoie true si rowCount>0 / false sinon
    return ($pdoStatement->rowCount() > 0);
  }
  #End Region

  // ==========================
  // 🔍 Getters and 🖊️ Setters
  // ==========================

  #Region

  /**
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   */
  public function setName($name): self
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of class_id
   */
  public function getClassId()
  {
    return $this->class_id;
  }

  /**
   * Set the value of class_id
   */
  public function setClassId($class_id): self
  {
    $this->class_id = $class_id;

    return $this;
  }

  /**
   * Get the value of picture
   */
  public function getPicture()
  {
    return $this->picture;
  }

  /**
   * Set the value of picture
   */
  public function setPicture($picture): self
  {
    $this->picture = $picture;

    return $this;
  }

  /**
   * Get the value of description
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   */
  public function setDescription($description): self
  {
    $this->description = $description;

    return $this;
  }

  // /**
  //  * Get the value of class_id
  //  */
  // public function getTypeId()
  // {
  //   return $this->type_id;
  // }

  // /**
  //  * Set the value of class_id
  //  */
  // public function setTypeId($type_id): self
  // {
  //   $this->type_id = $type_id;

  //   return $this;
  // }

  #End Region

  // ===================
  // 🗃️ Autres méthodes
  // ===================

}
