<?php

namespace App\Validation;

class Rules
{
    public function alpha_accented_numeric_space(string $value, ?string &$error = null): bool
    {
        return preg_match('/^[A-zÀ-ú0-9 ]+$/', $value);
    }
}