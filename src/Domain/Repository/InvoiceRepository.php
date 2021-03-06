<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Invoice;
use App\Domain\User;
use Symfony\Component\Uid\Uuid;

interface InvoiceRepository
{
    public function add(Invoice $invoice): void;

    public function getByMonthAndOwner(int $month, int $year, User $owner): array;

    public function remove(Uuid $getId): void;

    public function getByIdAndUser(Uuid $id, User $user): Invoice|null;
}
