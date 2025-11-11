<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Excel Import/Export Settings
    |--------------------------------------------------------------------------
    |
    | Here you can configure the default settings for all Excel imports and
    | exports. You can override these settings on a per-import or per-export
    | basis if needed.
    |
    */

    'imports' => [
        'heading'                => 'slugged', // 'slugged'|'none'|'column' - Default is 'slugged'
        'csv'                    => [
            'delimiter'          => ',', // The delimiter for CSV files
            'enclosure'          => '"', // The enclosure for CSV files
            'escape'             => '\\', // The escape character for CSV files
        ],
    ],

    'exports' => [
        'heading'                => 'slugged', // 'slugged'|'none'|'column'
    ],

    /*
    |--------------------------------------------------------------------------
    | Temporary File Settings
    |--------------------------------------------------------------------------
    |
    | When importing/exporting large files, temporary files are used. Here you
    | can set the directory where the temporary files will be stored.
    |
    | By default, Excel uses the local storage disk, but you can configure it
    | to use cloud storage like S3 if you prefer to store temporary files in
    | the cloud instead of the local file system.
    |
    */

    'temporary_files' => [
        'disk' => env('FILESYSTEM_DISK'),  // Use cloud storage (S3) for temporary files
    ],

    /*
    |--------------------------------------------------------------------------
    | Excel Export/Import Filters
    |--------------------------------------------------------------------------
    |
    | You can apply filters on Excel exports and imports. These filters will
    | be applied globally, and can also be overridden for specific imports
    | or exports.
    |
    */

    'filters' => [
        'chunk_size' => 1000, // The size of data chunks when importing/exporting
        'max_rows'   => 10000, // The maximum number of rows allowed for imports/exports
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto-Generate Headers
    |--------------------------------------------------------------------------
    |
    | When importing or exporting, you can automatically generate headers for
    | your files based on the column names or use custom headers.
    |
    | You can set this to `true` to auto-generate headers.
    |
    */

    'headers' => [
        'auto_generate' => true, // If true, headers will be auto-generated based on column names
    ],

    /*
    |--------------------------------------------------------------------------
    | Extension Configuration
    |--------------------------------------------------------------------------
    |
    | Excel supports various file formats. Below you can configure settings
    | for the different file extensions.
    |
    | Supported formats are .xlsx, .xls, .csv, .ods, and .xlsm.
    |
    */

    'extensions' => [
        'xlsx' => [
            'spreadsheet' => 'xlsx', // Use spreadsheet format for .xlsx files
        ],
        'csv'  => [
            'delimiter' => ',',  // CSV delimiter
        ],
        // Additional formats can be added here if needed
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload File Validation
    |--------------------------------------------------------------------------
    |
    | You can validate the uploaded files before importing them. By default,
    | files should be .xlsx, .xls, or .csv. You can change the validation rules
    | here if needed.
    |
    */

    'validation' => [
        'file' => 'required|file|mimes:xlsx,xls,csv|max:10240', // Example validation rules
    ],

];
