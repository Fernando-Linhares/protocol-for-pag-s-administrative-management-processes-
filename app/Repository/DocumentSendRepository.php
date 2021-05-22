<?php
namespace App\Repository;

use App\Repository\Contracts\DocumentSendRepositoryInterface;

class DocumentSendRepository implements DocumentSendRepositoryInterface
{
    use BaseDocumentRepository;

    public function transferDocument(int $user,int $document): bool
    {
        return $this->processManegementTransfer(
            user_id: $user,
            document_id: $document,
            value: false
        );
    }

    public function aceptDocument(int $user, int $document): bool
    {
        return $this->processManegementTransfer(
            user_id: $user,
            document_id: $document,
            value: true
        );
    }

    public function newDocument(int $user, array $document): bool
    {
        return $this->createDocument($user,$document);
    }
}