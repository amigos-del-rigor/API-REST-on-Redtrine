<?php
Namespace ADR\RESTBundle\Services\Storage;

interface HandlerInterface
{
    public function addNode(Shard $shard);
    public function getNumberOfNodes();
    public function getKeySpace();
}