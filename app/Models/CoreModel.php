<?php

namespace App\Models;

abstract class CoreModel
{

  protected $id;

  // ==========================
  // 🔍 Getters and 🖊️ Setters
  // ==========================

  public function getId(): ?int
  {
      return $this->id;
  }
}
