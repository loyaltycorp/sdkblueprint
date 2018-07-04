<?php
declare(strict_types=1);

namespace LoyaltyCorp\SdkBlueprint\Sdk\Exceptions;

use EoneoPay\Utils\Exceptions\ValidationException as BaseValidationException;
use Throwable;

class ValidationException extends BaseValidationException
{
    /**
     * The sub error code.
     *
     * @var int
     */
    protected $subCode;

    /**
     * Instantiate attributes.
     *
     * @param null|string $message
     * @param null|int $code
     * @param null|\Throwable $previous
     * @param null|string[] $errors
     * @param null|int $subCode
     */
    public function __construct(
        ?string $message = null,
        ?int $code = null,
        ?Throwable $previous = null,
        ?array $errors = null,
        ?int $subCode = null
    ) {
        parent::__construct($message ?? '', $code ?? 0, $previous, $errors);

        $this->subCode = $subCode ?? 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorCode(): int
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorSubCode(): int
    {
        return $this->subCode;
    }
}
