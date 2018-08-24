<?php
namespace PhpPot\Controller;

interface iRequestHandler
{

    /**
     * Common entry point for the request handler
     */
    public function handleRequest();

    public function handleAdd();

    public function handleEdit();

    public function handleDelete();

    public function handleList();
}