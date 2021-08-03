<?php
namespace App\Repository;

use App\Models\Historic;
use App\Models\Document;

trait BaseDocumentRepository
{
    public function processManegementTransfer(int $user_id,int $document_id, bool $value=false): bool
    {
        $document = Document::find($document_id);
        $document->user_id = $user_id;
        $document->save();

        if(Historic::create(['user_id'=>$user_id, 'doc_id'=>$document_id,'acept'=>$value]))
            return true;

        return false;
    }

    public function createDocument(int $user_id, array $document): bool
    {
        if($document_id = Document::create($document)->id)
            return $this->processManegementTransfer($user_id, $document_id, true);

        return false;
    }

}
