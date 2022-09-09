<?php

namespace App\Services\ThirdParty\CollectApi\DTO\Collection;

use App\Services\ThirdParty\CollectApi\DTO\Data\ImdbData;
use Spatie\DataTransferObject\DataTransferObjectCollection;

class ImdbCollection extends DataTransferObjectCollection
{
    public function current(): ImdbData
    {
        return parent::current();
    }

    /**
     * @param  array  $data
     * @return ImdbCollection
     */
    public static function fromArray(array $data): ImdbCollection
    {
        return new static(
            array_map(fn($item) => ImdbData::fromApi($item), $data)
        );
    }
}
