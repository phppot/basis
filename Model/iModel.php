<?php
namespace PhpPot\Controller;

interface iModel
{

    public function add();

    public function editById($id);

    public function deleteById($id);

    public function getById($id);
}