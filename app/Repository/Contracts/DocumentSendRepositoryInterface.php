<?php
namespace App\Repository\Contracts;

interface DocumentSendRepositoryInterface
{
    public function transferDocument(int $user,int $document): bool;

    public function aceptDocument(int $user, int $document): bool;

    public function newDocument(int $user,array $document): bool;
}