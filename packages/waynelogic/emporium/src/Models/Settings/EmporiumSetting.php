<?php

namespace Waynelogic\Emporium\Models\Settings;

use Waynelogic\FilamentCms\System\Models\SettingModel;

class EmporiumSetting extends SettingModel
{
    protected string $code = 'emporium_setting';

    protected $casts = [
        'identifiers' => 'array',
    ];
}
