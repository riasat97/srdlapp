<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
    'font_path' => storage_path('fonts/'),
    'font_data' => [
        'bangla' => [
            'R'  => 'Nikosh.ttf',    // regular font
            'B'  => 'Nikosh.ttf',       // optional: bold font
            'I'  => 'Nikosh.ttf',     // optional: italic font
            'BI' => 'Nikosh.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
    ],
];
