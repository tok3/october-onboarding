<?php

namespace Eq3w\Onboarding\Classes;

use Eq3w\Onboarding\Models\Company as Comp;
use Eq3w\Onboarding\Models\FinInfo;
use Eq3w\Onboarding\Models\CardDetails;
use Eq3w\Onboarding\Models\MarketingMaterial;
use Eq3w\Onboarding\Models\Contact;
use Eq3w\Onboarding\Models\ContactTypes;


use Faker;
use Hash;
use DB;

/**
 * Request Data from various API
 *
 * @package Eq3w\Onboarding\Classes
 */
class Helper
{

    /**
     * ApiRequest constructor.
     */
    public function __construct($_apiBase = '', $json_decode = false, $json_assoc = false)
    {

    }



    /**
     * @return mixed
     */
    public static function getCountries()
    {

        return DB::table('rainlab_location_countries')->select('*')->get();

    }



    public static function prep()
    {



        $faker = Faker\Factory::create();
        $faker = Faker\Factory::create('sk_SK'); // create a French faker
        $fakerES = Faker\Factory::create('es_ES'); // create a French faker


        $comp = new \Eq3w\Onboarding\Models\Company();
        for ($i = 0; $i < 50; $i++)
        {

            $crTime = date('Y-m-d H:i:s', time());
            $company = new Comp;

            $company_id = $company->insertGetId([
                    'name' => '',
                    'created_at' => $crTime
                ]
            );

            // ----------------

            $compData['address'] = $faker->streetName . ' ' . $faker->buildingNumber;
            $compData['address_2'] = '';
            $compData['bic'] = substr($faker->swiftBicNumber, 0, 8);
            $compData['city'] = $faker->city;
            $compData['company_no'] = $faker->isbn10;
            $compData['iban'] = $faker->bankAccountNumber;
            $compData['name'] = $faker->company;
            $compData['postcode'] = $faker->postcode;
            $compData['bic'] = substr($faker->swiftBicNumber,0,11);
            $compData['vat_no'] = $faker->bankAccountNumber;
            $compData['onboarding_code'] = str_replace('/', '', Hash::make($company_id));

            // ----------------

            $company->where('id', $company_id)->update($compData);


            //-----------------------------------------------------
            // financial information
            $finInfo = new FinInfo();

            $isFininfo = $finInfo->where('company_id', $company_id)->count();

            $data['fininf']['company_id'] = $company_id;

            if ($isFininfo == 0)
            {
                $data['fininf']['disc_sales'] = 0.00;
                $data['fininf']['disc_engine'] = 0.00;
                $data['fininf']['disc_global'] = 0.00;

                $finInfo->insert($data['fininf']);
            }
            else
            {

                $finInfo->where('company_id', $company_id)->update($data['fininf']);
            }



        }

    }

}
