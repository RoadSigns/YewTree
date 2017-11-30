<?php

namespace YewTree\Core\Contracts;


interface IRouter
{
    public function generateRoutes();
    public function getController();
}