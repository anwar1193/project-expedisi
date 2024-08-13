<?php

// if (! function_exists('sendWaText')) {
//     function sendWaText($number, $message) {
//         $data = [
//             "api_key" => "TYBUL3W5VDXSUT9P",
//             "number_key" => "TAlgCr43YndCNG0g",
//             "phone_no" => $number,
//             "message" => $message,
//         ];

//         return $data;
//     }
// }

// if (! function_exists('sendWaUrl')) {
//     function sendWaUrl($number, $url) {
//         $data = [
//             "api_key" => "TYBUL3W5VDXSUT9P",
//             "number_key" => "TAlgCr43YndCNG0g",
//             "phone_no" => $number,
//             "url" => $url
//         ];

//         return $data;
//     }
// }
if (! function_exists('sendWaText')) {
    function sendWaText($number, $message) {
        $data = [
            "api_key" => "1EHXPGIu8cAaLxOnMsmWoZquvlJ1DP",
            "sender" => "6285103064051",
            "number" => $number,
            "message" => $message,
        ];

        return $data;
    }
}

if (! function_exists('sendWaUrl')) {
    function sendWaUrl($number, $caption, $url) {
        $data = [
            "api_key" => "1EHXPGIu8cAaLxOnMsmWoZquvlJ1DP",
            "sender" => "6285103064051",
            "number" => $number,
            "media_type" => 'document',
            "caption" => $caption,
            "url" => $url
        ];

        return $data;
    }
}