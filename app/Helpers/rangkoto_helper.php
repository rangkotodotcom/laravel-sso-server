<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Http\UploadedFile;

if (!function_exists('base64_json_encode')) {
    function base64_json_encode($str)
    {
        return base64_encode(json_encode($str));
    }
}

if (!function_exists('base64_json_decode')) {
    function base64_json_decode($str, $array = false)
    {
        return json_decode(base64_decode($str), $array);
    }
}

if (!function_exists('json_encrypt')) {
    function json_encrypt($str)
    {
        return encrypt(json_encode($str));
    }
}

if (!function_exists('json_decrypt')) {
    function json_decrypt($str, $array = false)
    {
        return json_decode(decrypt($str), $array);
    }
}

if (!function_exists('check_dir')) {
    function check_dir($path)
    {
        $allDirectory = Storage::allDirectories();

        if (!in_array($path, $allDirectory)) {
            $makeDir = Storage::makeDirectory($path);

            foreach ($allDirectory as $dir) {
                $file = $dir . '/index.html';
                if (!Storage::exists($file)) {
                    Storage::put($file, '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>');
                }
            }

            return $makeDir;
        }
    }
}

if (!function_exists('storage_url')) {
    function storage_url($path = null)
    {
        return Storage::url($path);
    }
}

if (!function_exists('storage_url2')) {
    function storage_url2($code)
    {
        return env('APP_URL') . "/attachment/{$code}";
    }
}

if (!function_exists('storage_path2')) {
    function storage_path2($path = '')
    {
        return Storage::path($path);
    }
}

if (!function_exists('is_ajax')) {
    function is_ajax($request)
    {
        if (!$request->ajax()) {
            $response = [
                'content'   => null,
                'message'   => 'Method not allowed'
            ];

            return response()->json($response, 405);
        }
    }
}

if (!function_exists('base64_to_file')) {
    function base64_to_file(string $value)
    {
        if (strpos($value, ';base64') !== false) {
            [, $value] = explode(';', $value);
            [, $value] = explode(',', $value);
        }

        $binaryData = base64_decode($value);
        $tmpFileName = tempnam(sys_get_temp_dir(), 'medialibrary');

        file_put_contents($tmpFileName, $binaryData);

        $tmpFile = new File($tmpFileName);

        $tmpFileObjectPathName = $tmpFile->getPathname();

        return new UploadedFile(
            $tmpFileObjectPathName,
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true
        );
    }
}

if (!function_exists('file_to_base64')) {
    function file_to_base64(string $filename, string $filepath)
    {
        $mime = '';
        $filebase = '';

        if (Storage::exists($filepath)) {
            $mime = Storage::mimeType($filepath);
            $file = Storage::get($filepath);
            $base64 = base64_decode($file);
            $filebase = "data:{$mime};base64,{$base64}";
        }

        return [
            'file_name' => $filename,
            'file_mime' => $mime,
            'file_base' => $filebase
        ];
    }
}

if (!function_exists('should_format_response_json')) {
    function should_format_response_json($request)
    {
        return ($request->is('api/*') || str_starts_with($request->getHost(), 'api.') || ($request->expectsJson() && !$request->is('*/search')));
    }
}

if (!function_exists('should_return_json')) {
    function should_return_json($request)
    {
        return ($request->is('api/*') ||
            str_starts_with($request->getHost(), 'api.') ||
            ($request->expectsJson() && !$request->is('*/search'))
        );
    }
}

if (!function_exists('create_url_file')) {
    function create_url_file($filename, $filepath)
    {
        $code = [
            'file_name' => $filename,
            'file_path' => $filepath,
        ];

        $code = json_encrypt($code);

        return storage_url2($code);
    }
}

if (!function_exists('date_time_str')) {
    function date_time_str($format, $str)
    {
        if ($str) {
            try {
                $dt = Carbon::createFromFormat($format, $str);

                if ($dt && $dt->format($format) === $str) {
                    return $dt->isoFormat($format);
                } else {
                    return "";
                }
            } catch (\Exception $e) {
                return "";
            }
        } else {
            return "";
        }
    }
}
