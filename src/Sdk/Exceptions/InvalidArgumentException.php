<?php
declare(strict_types=1);

namespace LoyaltyCorp\SdkBlueprint\Sdk\Exceptions;

class InvalidArgumentException extends SdkBlueprintException
{
    public function getErrorSubCode(): int
    {
        return 1;
    }
}