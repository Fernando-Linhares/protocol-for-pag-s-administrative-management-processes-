<?php
namespace App\Repository;

use App\Repository\Contracts\DocumentSendRepositoryInterface;
use App\Models\User;

class DocumentSendRepository implements DocumentSendRepositoryInterface
{
    use BaseDocumentRepository;

    /**
     * @param string $user
     * @param int $document
     * @return bool true|false
     */
    public function sendDocument(string $user,int $document): bool
    {
        return $this->processManegementTransfer(
            User::idByName($user),
            $document
        );
    }

    /**
     * @param string $user
     * @param int $document
     * @return bool true|false
     */
    public function aceptDocument(string $user, int $document): bool
    {
        return $this->processManegementTransfer(
            User::idByName($user),
            $document,
            true
        );
    }

    /**
     * @param string $user
     * @param int $document
     * @return bool true|false
     */
    public function newDocument(string $user, array $document): bool
    {
        return $this->createDocument(
            User::idByName($user),
            $document
        );
    }
}
