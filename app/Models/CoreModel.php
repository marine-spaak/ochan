<?php

namespace App\Models;

abstract class CoreModel
{

    protected $id;


    public function getId(): ?int
    {
        return $this->id;
    }
}