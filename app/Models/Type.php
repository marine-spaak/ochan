<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Type extends CoreModel
{
  // ==============
  // 💲 Propriétés
  // ==============

#Region

  private $name;

#End Region

  // =============================================================
  // 👻👶🏽 Méthodes abstraites qui deviennent réelles (coté fille)
  // =============================================================

  #Region
  // ➕ INSERT
  public function insert()
  {
  }

  // 🔍 FIND et FINDALL
  public static function find($id)
  {
    $pdo = Database::getPDO();
    $sql = 'SELECT * FROM `type` WHERE `id` =' . $id;
    $pdoStatement = $pdo->query($sql);
    $results = $pdoStatement->fetchObject('App\Models\Type');

    return $results;
  }

  public static function findAll()
  {
    $pdo = Database::getPDO();
    $sql = 'SELECT * FROM `type`';
    $pdoStatement = $pdo->query($sql);
    $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');

    return $results;
  }

  // 📝 UPDATE
  public function update()
  {
  }

  // ❌ DELETE
  public static function delete($id)
  {
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

#End Region

  // ===================
  // 🗃️ Autres méthodes
  // ===================

}
