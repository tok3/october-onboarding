<?php namespace Eq3w\Onboarding\Components;

use Cms\Classes\ComponentBase;
use Eq3w\Onboarding\Models\Company;

use Event;
use Faker;


class Companies extends ComponentBase
{

    /**
     * Edit page
     *
     * @var string
     */
    public $editLink;

    public function componentDetails()
    {
        return [
            'name' => 'Companies Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'editLink' => [
                'title' => 'Edit Page',
                'description' => 'Edid page',
                'default' => 'company/edit/{{ :id }}',
                'type' => 'string',
            ],
            'categoryFilter' => [
                'title' => 'rainlab.blog::lang.settings.posts_filter',
                'description' => 'rainlab.blog::lang.settings.posts_filter_description',
                'type' => 'string',
                'default' => '',
            ],
            'postsPerPage' => [
                'title' => 'rainlab.blog::lang.settings.posts_per_page',
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'rainlab.blog::lang.settings.posts_per_page_validation',
                'default' => '10',
            ]

        ];
    }


    /**
     * @return mixed
     */
    public function companies()
    {
        return Company::all();
    }


    protected function prepareVars()
    {

        $this->editLink = $this->page['editLink'] = $this->property('editLink');
    }


    public function getProperty($editLink)
    {
        return $this->property('editLink');
    }


    /**
     * generate faker entries
     *
     */
    public function fakesave()
    {


        return;

        $faker = Faker\Factory::create();
        $faker = Faker\Factory::create('sk_SK'); // create a French faker
        $fakerES = Faker\Factory::create('es_ES'); // create a French faker


        $comp = new Company();
        for ($i = 0; $i < 500; $i++)
        {

            $insertData['address'] = $faker->streetName . ' ' . $faker->buildingNumber;
            $insertData['address_2'] = '';
            $insertData['bic'] = substr($faker->swiftBicNumber, 0, 8);
            $insertData['city'] = $faker->city;
            $insertData['company_no'] = $faker->isbn10;
            $insertData['iban'] = $faker->bankAccountNumber;
            $insertData['name'] = $faker->company;
            $insertData['postcode'] = $faker->postcode;
            $insertData['swift'] = $faker->swiftBicNumber;
            $insertData['vat_no'] = $faker->bankAccountNumber;

            $comp->insert($insertData);

        }


    }

    function onRun()
    {
        $this->addJs('/plugins/eq3w/onboarding/assets/javascript/plugin.js?cb=' . time());
        $this->addCss('/plugins/eq3w/onboarding/assets/css/plugin.css?cb=' . time());
    }
}
