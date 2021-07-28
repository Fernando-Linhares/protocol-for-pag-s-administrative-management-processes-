<?php
namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface DisplayInterface
{
    public function getCronogram(int $document_number): Collection;
}
