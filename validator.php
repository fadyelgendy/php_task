<?php
/**
 * Validate string, return back if error, nothing if passed
 *
 * @param string $key
 * @param string $value
 * @param int $min
 * @param int $max
 * @return void
 */
function validateString(string $key, string $value, int $min = 4, int $max = 255): void
{
    $value = trim($value);

    // Value exists
    if (!isset($value)) {
        abort($key,"{$key} Is required!.");
    }

    // Value Not empty
    if (empty($value)) {
        abort($key,"{$key} Can not be empty!.");
    }

    $strlen = strlen($value);
    // Min Length
    if ($strlen < $min) {
        abort($key,"{$key} Must be at least {$min} characters!");
    }

    // Max Length
    if ($strlen < $min) {
        abort($key,"{$key} Must not be greater than {$max} characters!");
    }

    // Value not matched
    if (!preg_match("/[a-zA-Z]/", $value)) {
        abort($key,"{$key} is invalid!.");
    }
}

/**
 * Validate File
 * redirect back when error, nothing if passed
 * @param $file
 * @param float $size [in KB, like 2048 => 2MB ]
 * @param string $type
 * @param array $mimes
 * @return void
 */
function validateFile($file, float $size, string $type, array $mimes): void
{
    // File Not set
    if (!isset($file)) {
        abort($type,"File is required!");
    }

    $file_name = $file['tmp_name'];

    // is file and is uploaded via post
    if (!is_file($file_name) || !is_uploaded_file($file_name)) {
        abort($type,"File is invalid!");
    }

    $sizeInMB = $size / 1024;
    // Size Not Match
    if (filesize($file_name) > ($size * BYTE_SIZE)) {
        abort($type,"File size must be less than or equal to {$sizeInMB}MB!");
    }

    $file_details = getFileTypeAndMime($file_name);

    // File Type
    if ($file_details['type'] != $type) {
        abort($type,"File Must be of type {$type}");
    }

    // Mime
    if (! in_array($file_details['mime'], $mimes)) {
        $mimesString = implode(',', $mimes);
        abort($type,"File must be one of {$mimesString}");
    }
}

/**
 * Return file type and mime
 *
 * @param string $file_name
 * @return array
 */
function getFileTypeAndMime(string $file_name): array
{
    $file_details = explode("/", mime_content_type($file_name));

    return [
        'type' => $file_details[0],
        'mime' => $file_details[1],
    ];
}