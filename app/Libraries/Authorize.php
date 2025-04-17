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

    public function canAccessAdminHome(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        $groups = $user->getGroups();
        $permissions = $user->getPermissions();
        unset($groups['user']);
        unset($groups['beta']);
        unset($permissions['beta.access']);
        return $groups || $permissions;
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