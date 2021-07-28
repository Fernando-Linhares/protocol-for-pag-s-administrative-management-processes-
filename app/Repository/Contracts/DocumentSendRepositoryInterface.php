<?php
namespace App\Repository\Contracts;

interface DocumentSendRepositoryInterface
{
    public function sendDocument(string $user,int $document): bool;

    public function aceptDocument(string $user, int $document): bool;

    public function newDocument(string $user, array $document): bool;

    public function getDocumentsOf(object $user, bool $acept);
}
