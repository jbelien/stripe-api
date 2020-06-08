<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014-2016 Zend Technologies USA Inc. (http://www.zend.com)
 */
use Laminas\ApiTools\Admin\Model\ModulePathSpec;

return [
    'view_manager' => [
        'display_exceptions' => true,
    ],
    'api-tools-admin' => [
        'path_spec' => ModulePathSpec::PSR_4,
    ],
    'api-tools-configuration' => [
        'enable_short_array' => true,
        'class_name_scalars' => true,
    ],
];
