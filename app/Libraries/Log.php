<?php

namespace App\Libraries;

use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class Log
{
    public static function unexpectedError(Exception $e): RedirectResponse
    {
        log_message('critical', $e->getMessage());
        if (Events::Trigger('in_group', 'developer'))
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Erro no servidor, favor contatar o suporte.');
    }

}
