<?php

namespace App\Traits\Models;

trait ValidateTrait
{
    /**
     * Validate the row data against the validation rules (or the validation group)
     * specified in the class property, $validationRules.
     *
     * @param         array|object     $row Row data
     */
    public function validate($row, ?bool $cleanValidationRules = null): bool
    {
        if ($cleanValidationRules === null) $cleanValidationRules = $this->cleanValidationRules;
        if ($this->skipValidation) {
            return true;
        }

        $rules = $this->getValidationRules();

        if ($rules === []) {
            return true;
        }

        // Validation requires array, so cast away.
        if (is_object($row)) {
            $row = (array)$row;
        }

        if ($row === []) {
            return true;
        }

        $rules = $cleanValidationRules ? $this->cleanValidationRules($rules, $row) : $rules;

        // If no data existed that needs validation
        // our job is done here.
        if ($rules === []) {
            return true;
        }

        $this->ensureValidation();

        $this->validation->reset()->setRules($rules, $this->validationMessages);

        return $this->validation->run($row, null, $this->DBGroup);
    }
}