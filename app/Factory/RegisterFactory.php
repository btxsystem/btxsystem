<?php

namespace App\Factory;
use App\Service\RegisterService;
use App\Service\RegisterServiceMake;

interface RegisterFactory
{
  function call(): RegisterService;
}

class RegisterFactoryMake implements RegisterFactory
{
  function call(): RegisterService
  {
    return new RegisterServiceMake();
  }
}