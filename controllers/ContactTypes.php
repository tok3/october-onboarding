<?php namespace Eq3w\Onboarding\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class ContactTypes extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Eq3w.Onboarding', 'main-menu-item', 'side-menu-item');
    }
}
