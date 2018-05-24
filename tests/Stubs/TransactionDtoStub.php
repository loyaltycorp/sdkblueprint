<?php
declare(strict_types=1);

namespace Tests\LoyaltyCorp\SdkBlueprint\Stubs;

use LoyaltyCorp\SdkBlueprint\Sdk\DataTransferObject;

/**
 * @method string getAmount()
 * @method string getCurrency()
 * @method DataTransferObjectStub getDto()
 * @method self setAmount(string $amount)
 * @method self setCurrency(string $currency)
 * @method self setDto(DataTransferObjectStub $dto)
 */
class TransactionDtoStub extends DataTransferObject
{
    /**
     * {@inheritdoc}
     */
    public function embedObjects(): array
    {
        return ['dto' => DataTransferObjectStub::class];
    }

    /**
     * {@inheritdoc}
     */
    protected function hasAttributes(): array
    {
        return [
            'dto',
            'amount',
            'currency'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function hasValidationRules(): array
    {
        return [
            'dto' => 'required'
        ];
    }
}