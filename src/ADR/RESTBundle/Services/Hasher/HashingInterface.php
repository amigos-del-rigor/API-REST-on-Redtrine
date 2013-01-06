<?php
Namespace ADR\RESTBundle\Services\Hasher;

interface HashingInterface
{
    public function getNewKey();
    public function getNode($key);
}