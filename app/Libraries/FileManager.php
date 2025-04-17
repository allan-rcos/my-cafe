<?php

namespace App\Libraries;

use CodeIgniter\Files\Exceptions\FileException;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;

class FileManager
{
    const URI = 'assets\\images\\uploads';
    const DIRECTORY = '..\\..\\public\\'.self::URI;
    const ABSOLUTE = FCPATH.self::URI;
    const DEFAULT_IMAGE = 'https://upload.wikimedia.org/wikipedia/commons/0/0e/DefaultImage.png';

    public static function getRules(string $field): array
    {
        return [
            "$field" => "uploaded[$field]".
                        "|is_image[$field]".
                        "|mime_in[$field,image/jpg,image/jpeg,image/png,image/webp]" // .
//                        "|max_size[$field,100]".
//                        "|max_dims[$field,1024,768]",
        ];
    }

    public static function store(UploadedFile $file, string $new_filename): ?string
    {
        if (!$file->hasMoved())
            return $file->store(self::DIRECTORY, $new_filename);
        return null;
    }

    public static function get(string $filename): File
    {
        return new File(self::absoluteFilename($filename));
    }

    public static function exists(string $filename): bool
    {
        return file_exists(self::absoluteFilename($filename));
    }

    public static function remove(string $filename, bool $throw = true): bool
    {
        $unlink = @unlink(self::absoluteFilename($filename));

        if(!$unlink && $throw)
            throw new FileException("Error to remove the file '$filename'");

        return $unlink;
    }

    public static function rename(string $filename, string $new_filename): bool
    {
        $destination = self::absoluteFilename($new_filename);
        if (! @rename(self::absoluteFilename($filename), $destination)) {
            $error = error_get_last();

            throw FileException::forUnableToMove($filename, self::DIRECTORY, strip_tags($error['message']));
        }

        @chmod($destination, 0777 & ~umask());
        return true;
    }

    public static function getExtension(string $filename): string
    {
        return substr($filename, strrpos($filename, '.'));
    }

    public static function filenameFormat(string $name): string
    {
        helper('format');
        return strtolower(str_replace(' ', '_', strip_accents($name)));
    }

    public static function uriOrDefault(string $filename): string
    {
        if ($filename) return base_url(str_replace('\\', '/', self::URI).'/'.$filename);
        return self::DEFAULT_IMAGE;
    }

    private static function absoluteFilename(string $filename): string
    {
        return self::ABSOLUTE.DIRECTORY_SEPARATOR.$filename;
    }
}