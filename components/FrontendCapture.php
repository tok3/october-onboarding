<?php namespace Eq3w\Onboarding\Components;

use Cms\Classes\ComponentBase;

use Composer\Autoload\ClassLoader;
use Eq3w\Onboarding\Classes\Helper;
use Eq3w\Onboarding\Models\ContactTypes;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Eq3w\Onboarding\Models\Company as Comp;

use Event;
use ValidationException;
use Flash;

class FrontendCapture extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'FrontendCapture Component',
            'description' => 'Capturing Data on Frontend'
        ];
    }

    public function defineProperties()
    {
        return [];
    }


    /**
     * @param Company $company
     * @return mixed
     */
    public function save(Company $company)
    {

        $rules = [
            'company.name' => 'required',
            'company.address' => 'required',
            'company.address' => 'required',
            'company.postcode' => 'required',
            'company.city' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('capture')->withErrors($validator)->withInput();
        }
        else
        {
            $indserDataComp = Input::get('company');

            $company->insert($indserDataComp);

            return Redirect::to('capture')->withSucces('Danke für die Mühe')->withInput();
        }

    }


    /**
     * Get all available Contact Types
     *
     * @return mixed
     */
    public function contactTypes()
    {

        $types = ContactTypes::get();

        return $types;
    }

    /**
     * Get all Company Data
     *
     * @return mixed
     */
    public function getCompData()
    {

        $compData =  Comp::where('onboarding_code', $this->param('code'))->first();

        if(empty($compData))
        {

            \Session::forget('obCode');

        }

        return $compData;
    }
    /**
     * @return mixed
     */
    public function getCountries()
    {

        return Helper::getCountries();

    }


    /**
     * @return mixed
     */
    public function getCode()
    {

        if (null !== $this->param('code'))
        {
            \Session::put('obCode', $this->param('code'));

            return $this->param('code');
        }
        elseif (\Session::has('obCode'))
        {

            return \Session::get('obCode');
        }


        return $this->param('code');
    }

    /**
     *
     */
    public function onRender()
    {


        // This code will be executed before the default component
        // markup is rendered on the page or layout.


    }

    public function onInit()
    {
        $this->controller->addComponent('\Eq3w\Onboarding\Components\Company', 'Company', []);
    }

    /**
     *
     */
    public function onRun()
    {
        $this->addJs('/themes/unify/assets/vendor/SmartWizard-master/dist/js/jquery.smartWizard.js');
        $this->addJs('/plugins/eq3w/onboarding/assets/javascript/plugin-fe.js?cb=' . time());

        $this->addCss('/plugins/eq3w/onboarding/assets/css/plugin.css?cb=' . time());
        $this->addCss('/themes/unify/assets/vendor/SmartWizard-master/dist/css/smart_wizard.css?t=' . time());
        $this->addCss('/themes/unify/assets/vendor/SmartWizard-master/dist/css/smart_wizard_theme_arrows.css?t=' . time());
    }


    function onSubmit()
    {
       $data = post();

       $rules = [
           'email'=>'email'
       ];


        $validation = Validator::make($data, $rules);


        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        \Flash::success('Jobs done!');

    }


}
