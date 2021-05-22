<?php
namespace App\Repository;

use App\Models\{
    Historic,
    Storage,
    Document
};

trait BaseDocumentRepository
{
    public function processManegementTransfer(int $user_id,int $document_id, bool $value): bool
    {
        $historic = new Historic;
        $historic->user_id = $user_id;
        $historic->doc_id = $document_id;
        $historic->acept = $value;

        $storage = Storage::where('doc_id',$document_id)->first();
        $storage->ondashboard = $value;
        $storage->user_id = $user_id;
        $storage->save();

        return $historic->save() && $storage->save;
    }

    public function createDocument(int $user_id, array $document): bool
    {
        $document_id = Document::create($document)->id;

        Historic::create([
            'id'=>null,
            'doc_id'=>$document_id,
            'user_id'=>$user_id,
            'acept'=>true
            ]);

        Storage::create([
            'id'=>null,
            'doc_id'=>$document_id,
            'user_id'=>$user_id,
            'ondashboard'=>true
            ]);

        return true;
    }
}