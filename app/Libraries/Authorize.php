<?php

namespace App\Libraries;

use CodeIgniter\HTTP\RedirectResponse;

class Authorize
{
    public bool $isTest = false;

    public function redirectIfNotHavePermission(string ...$permissions): ?RedirectResponse
    {
        if (!$this->isTest)
            if (!auth()->user()->can(...$permissions))
                return redirect()->back()->with('error', 'Não autorizado, permissão necessária não encontrada.');
        return null;
    }

    public function can(string ...$permissions): bool
    {
        if ($this->isTest) return $this->isTest;
        return auth()->user()->can(...$permissions);
    }

    public function inGroup(string ...$groups): bool
    {
        if ($this->isTest) return $this->isTest;
        return auth()->user()->inGroup(...$groups);
    }
}