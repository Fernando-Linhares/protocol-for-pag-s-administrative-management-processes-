<?php
namespace App\Services;

use App\Models\Historic;
use Illuminate\Database\Eloquent\Collection;

class DisplayHistoric implements Contracts\DisplayInterface
{
    public function getCronogram(int $document_number): Collection
    {
        return Historic::get()->filter(
            function($historic)use($document_number){
            return $historic->document->number == $document_number;
        });
    }
}
