<?php namespace Eq3w\Onboarding;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Eq3w\Onboarding\Components\FrontendCapture' => 'frontendCapture',
            'Eq3w\Onboarding\Components\Companies' => 'companies',
            'Eq3w\Onboarding\Components\Company' => 'company'
        ];
    }

    public function registerSettings()
    {

    }


}
