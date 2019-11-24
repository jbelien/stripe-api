<?php

/**
 * This is the config file for ZfrCors. Just drop this file into your config/autoload folder (don't
 * forget to remove the .dist extension from the file), and configure it as you want
 * @see https://www.apigility.org/documentation/recipes/allowing-request-from-other-domains
 */

return [
    'zfr_cors' => [
        /**
         * Set the list of HTTP verbs.
         */
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],

        /**
         * Standard CORS requests do not send or set any cookies by default. For this to work,
         * the client must set the XMLHttpRequest's "withCredentials" property to "true". For
         * this to work, you must set this option to true so that the server can serve
         * the proper response header.
         */
        'allowed_credentials' => false,
    ],
];
