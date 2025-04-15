<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Enums\AdminViewEnum;
use App\Exceptions\AdminControllerException;
use App\Libraries\TableHandler;
use App\Models\Interface\IAdminModel;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Model;
use Exception;

/** @template ModelTemplate of Model */
abstract class AdminBaseController extends BaseController
{
    /** @var array<'create'|'index'|'edit'|'remove', string> */
    protected $permissions              = [];

    /** @var array<'create'|'index'|'edit'|'remove', string> */
    protected $permissionMessages       = [];

    /** @var array<'create'|'edit'|'remove', string> */
    protected $successMessages          = [];

    /** @var string */
    protected $defaultPermissionMessage = 'Permission denied.';

    protected $defaultSuccessMessage    = 'Success!';

    /** @var array<'create'|'index'|'edit', string> */
    protected $views                    = [];

    /** @var ModelTemplate */
    protected $modelType                = null;


    /** @var string */
    protected $table_dir                = '';
    /** @var array<'create'|'index'|'edit'|'remove', string> */
    protected $table_header             = [ ];

    /** @var string */
    protected $redirectRoute            = '';

    /**
     * Made validations to discover if a Bad Configuration is in the class.
     * In production this method is skipped.
     * @param AdminViewEnum $viewType
     * @return string
     * @throws AdminControllerException
     */
    protected function validateConfig(AdminViewEnum $viewType): string
    {
        $view = $viewType->value;
        if (getenv('CI_ENVIRONMENT') === 'production') return $view;

        if (!array_key_exists($view, $this->permissions))
            throw new AdminControllerException("Permission for \"$view\" view is missing.");
        if (!array_key_exists($view, $this->views) and $viewType !== AdminViewEnum::REMOVE)
            throw new AdminControllerException("View Path for \"$view\" view is missing.");

        if (!$this->modelType)
            throw new AdminControllerException("Model type is mandatory.");

        $implements = class_implements($this->modelType);
        if ($implements === false || !in_array(IAdminModel::class, $implements))
            throw new AdminControllerException('Model Class needs to implement IAdminModel.');

        if ($viewType === AdminViewEnum::INDEX)
        {
            if (!$this->table_dir)
                throw new AdminControllerException('Table Dir is required for Index view.');
            if (!$this->table_header)
                throw new AdminControllerException('Table header is required for Index view.');
        }
        if ($viewType === AdminViewEnum::CREATE || $viewType === AdminViewEnum::EDIT)
        {
            if (!$this->redirectRoute)
                throw new AdminControllerException('Redirect Route is required for Create and Edit views.');
        }

        return $view;
    }

    /**
     * @return         ModelTemplate|null
     * @phpstan-return ($modelType is class-string<ModelTemplate> ? ModelTemplate : object|null)
     */
    protected function getModel()
    {
        return model($this->modelType);
    }

    protected function checkPermission(string $view): ?RedirectResponse
    {
        if (!Events::trigger('can', $this->permissions[$view]))
            return redirect()->back()->with('error',
                $this->permissionMessages[$view] ?? $this->defaultPermissionMessage);
        return null;
    }
}

