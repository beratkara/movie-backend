<?php

namespace App\Contracts;

interface MovieServiceInterface
{
    public function make($name): MovieRepositoryInterface;
}
