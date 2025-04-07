<?php

namespace Config;

use App\Libraries\Authorize;
use App\Libraries\FileManager;
use App\Libraries\FormHandler;
use App\Libraries\Log;
use App\Libraries\TableHandler;
use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 *
 */
class Services extends BaseService
{

    public static function log($getShared = true): Log
    {
        if ($getShared) {
            /** @var Log $object */
            $object = static::getSharedInstance('log');
            return $object;
        }

        return new Log();
    }

    public static function authorize($getShared = true): Authorize
    {
        if ($getShared) {
            /** @var Authorize $object */
            $object = static::getSharedInstance('authorize');
            return $object;
        }

        return new Authorize();
    }

    public static function file_manager($getShared = true): FileManager
    {
        if ($getShared) {
            /** @var FileManager $object */
            $object = static::getSharedInstance('file_manager');
            return $object;
        }

        return new FileManager();
    }

    public static function form_handler($getShared = true): FormHandler
    {
        if ($getShared) {
            /** @var FormHandler $object */
            $object = static::getSharedInstance('form_handler');
            return $object;
        }

        return new FormHandler();
    }

    public static function table_handler($getShared = true): TableHandler
    {
        if ($getShared) {
            /** @var TableHandler $object */
            $object = static::getSharedInstance('table_handler');
            return $object;
        }

        return new TableHandler();
    }
}
