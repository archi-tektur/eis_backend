<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Infrastructure\Symfony\Validator as ApplicationAssert;
use Symfony\Component\Validator\Constraints as Assert;

class CreateInvoiceCommand
{
    #[Assert\NotBlank]
    private string $name;

    #[ApplicationAssert\IsInvoiceType]
    private string $type;

    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
