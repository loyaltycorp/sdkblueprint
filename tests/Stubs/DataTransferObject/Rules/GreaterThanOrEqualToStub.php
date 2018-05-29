<?php
declare(strict_types=1);

namespace Tests\LoyaltyCorp\SdkBlueprint\Stubs\DataTransferObject\Rules;

class GreaterThanOrEqualToStub extends BaseStub
{
    /**
     * {@inheritdoc}
     */
    protected function getRuleString(): string
    {
        return 'greaterThanOrEqualTo:20';
    }
}
