<?php

if (!function_exists('getFoxlisGeoConfig_default')) {
    function getFoxlisGeoConfig_default()
    {
        return [
            // Main Settings
            'foxlis_geo_field_session' => true,
            'foxlis_geo_field_bot_filter' => true,
            'foxlis_geo_field_protocol' => 'http',

            // Development Settings
            'foxlis_geo_field_development_fake_ip_enable' => false,
            'foxlis_geo_field_development_fake_ip' => '23.55.115.223',

            // Foxlis Geo Account Key
            'foxlis_geo_field_account' => '',

            // Bots List
            'foxlis_geo_bots_list' => [
                'cncat',
                'google',
                'megaindex',
                'openstat',
                'vkshare',
                'yadirectfetcher',
                'yahoo',
                'yandex',
                'crawler',
                'bot',
                'rambler',
                'spider',
                'snoopy',
                'finder',
                'mail',
                'wget',
                'curl',
            ],
        ];
    }
}
