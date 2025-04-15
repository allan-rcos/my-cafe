<?php

namespace App\Models\Interface;

interface IAdminModel
{
    /**
     * Validate the row data against the validation rules (or the validation group)
     * specified in the class property, $validationRules.
     *
     * @param         array|object     $row Row data
     */
    public function validate($row, ?bool $cleanValidationRules = null): bool;

    public function count(): int;

    public function findAllTableData(int $limit = 10, string $order_by = 'id', string $order = 'ASC'): array;
}