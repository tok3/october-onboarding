<?php namespace Eq3w\Onboarding\Components;

use Cms\Classes\ComponentBase;


use Eq3w\Onboarding\Models\Company as Comp;
use Eq3w\Onboarding\Models\FinInfo;
use Eq3w\Onboarding\Models\CardDetails;
use Eq3w\Onboarding\Models\MarketingMaterial;
use Eq3w\Onboarding\Models\Contact;
use Eq3w\Onboarding\Models\ContactTypes;
use Eq3w\Onboarding\Classes\Helper;

use Eq3w\Onboarding\Classes\Testdata as Test;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Hash;
use DB;

require 'vendor/autoload.php';

use Martin\Forms\Classes\GDPR;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Company extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Company Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }


    public static function getAfterFilters()
    {
        return [];
    }

    public static function getBeforeFilters()
    {
        return [];
    }

    public static function getMiddleware()
    {
        return [];
    }


    /**
     * Get all Company Data
     *
     * @return mixed
     */
    public function get()
    {


        return Comp::where('id', $this->param('id'))->first();

    }


    /**
     * Create Excel
     *
     * @param $id
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function createSpredsheet($id)
    {
        // config which fields are exported to excel sheet
        $fields = include('plugins/eq3w/onboarding/export-fields.php');


        /*  $this->testFieldsfunc($fields, $id);
          die();*/


        // ------------------------------------------------------
        // company


        $data = Comp::select(array_keys($fields['company']))->where('id', $id)->first();

        $spreadsheet = new Spreadsheet();
        $sheetIndex = $spreadsheet->getIndex(
            $spreadsheet->getSheetByName('Worksheet')
        );
        $spreadsheet->removeSheetByIndex($sheetIndex);


        // Create a new worksheet
        $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Company');

        $i = 0;
        $alphas = range('A', 'Z');

        foreach ($data->toArray() as $key => $value)
        {

            $worksheet->setCellValue($alphas[$i] . '1', $fields['company'][$key]);
            $worksheet->setCellValue($alphas[$i] . '2', $this->confFieldFunc($key, $value));
            ++$i;
        }

        $spreadsheet->addSheet($worksheet, 0);

        // ------------------------------------------------------
        // contacts

        foreach (ContactTypes::get() as $key => $item)
        {
            $contactTypes[$item->id] = $item->name;

        }

        $data = Contact::select(array_keys($fields['contacts']))->where('company_id', $id)->get()->toArray();

        // Create a new worksheet
        $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Contacts');
        $spreadsheet->addSheet($worksheet, 1);
        $spreadsheet->setActiveSheetIndex(1);
        $i = 0;
        $alphas = range('A', 'Z');

        if (isset($data[0]))
        {

            $row = 1;
            foreach ($data as $key => $cellData)
            {

                $cellData['type'] = $contactTypes[$cellData['type']];

                if ($row == 1)
                {
                    $spreadsheet->getActiveSheet()
                        ->fromArray(
                            array_keys($cellData),
                            NULL,
                            'A' . $row
                        );


                    ++$row;
                }

                $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $cellData,
                        NULL,
                        'A' . $row
                    );

                ++$row;


            }

        }

        // ------------------------------------------------------
        // financial information

        $data = FinInfo::select(array_keys($fields['financial_information']))->where('company_id', $id)->first();


        if (!empty($data))
        {

            // Create a new worksheet
            $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Financial Information');

            $i = 0;
            $alphas = range('A', 'Z');

            foreach ($data->toArray() as $key => $value)
            {
                $worksheet->setCellValue($alphas[$i] . '1', $fields['financial_information'][$key]);


                $worksheet->setCellValue($alphas[$i] . '2', $this->confFieldFunc($key, $value));

                ++$i;

            }


            $spreadsheet->addSheet($worksheet, 1);
        }
        // ------------------------------------------------------
        // Marketing Material

        $data = MarketingMaterial::select(array_keys($fields['marketing_material']))->where('company_id', $id)->first();

        if (!empty($data))
        {

            // Create a new worksheet
            $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Marketing');

            $i = 0;
            $alphas = range('A', 'Z');


            foreach ($data->toArray() as $key => $value)
            {
                $worksheet->setCellValue($alphas[$i] . '1', $fields['marketing_material'][$key]);
                $worksheet->setCellValue($alphas[$i] . '2', $this->confFieldFunc($key, $value));

                ++$i;
            }


            $spreadsheet->addSheet($worksheet, 3);
        }
        // ------------------------------------------------------
        // About Giftcard

        $data = CardDetails::select(array_keys($fields['giftcard_details']))->where('company_id', $id)->first();
        if (!empty($data))
        {

            // Create a new worksheet
            $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Giftcard Details');

            $i = 0;

            $alphas2 = $this->createColumnsArray('AZ', 'A');
            $alphas = array_merge($alphas, $alphas2);


            foreach ($data->toArray() as $key => $value)
            {
                $worksheet->setCellValue($alphas[$i] . '1', $fields['giftcard_details'][$key]);


                if ($key == 'ordering_api')
                {
                    $value = $this->getYN($value);
                }

                if (is_object($value))
                {
                    $value = $this->retSelJopt($value);

                }


                $worksheet->setCellValue($alphas[$i] . '2', $this->confFieldFunc($key, $value));

                ++$i;
            }


            $spreadsheet->addSheet($worksheet, 3);
        }

        // finally set active sheet
        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);

        $dataDir = 'onboarding';

        if (!\Storage::exists($dataDir))
        {
            \Storage::makeDirectory($dataDir);
        }

        $xlName = $id . '-onboarding.xlsx';

        $writer->save('storage/app/' . $dataDir . '/' . $xlName);


        //---------

        $this->pack($id);

    }


    /**
     * gathering users data and pack in tar archive
     *
     * @param $id
     */
    function pack($id)
    {
        $storagePath = 'storage/app/onboarding/';

        $company = Comp::where('id', $id)->first();
        $nameSlug = \Str::slug($company->name);

        $archFilename = 'onboarding-' . $nameSlug;
        $companyPath = $storagePath . $nameSlug;

        $data = MarketingMaterial::where('company_id', $id)->first();

        exec('mkdir ' . $companyPath);

        exec('mv ' . $storagePath . '/' . $id . '-*.xlsx ' . $companyPath);

        exec('cp ' . $data->moodpicture_local_path . ' ' . $companyPath);
        exec('cp ' . $data->cardimage_local_path . ' ' . $companyPath);
        exec('cp ' . $data->companylogo_local_path . ' ' . $companyPath);

        exec('rm -rf ' . $storagePath . '/' . $archFilename);

        exec('zip -jrm ' . $storagePath . '/' . $archFilename . '.zip ' . $storagePath . ' ' . $nameSlug);

        //exec('tar -czvf ' . $storagePath . '/' . $archFilename . '.tar  -C ' . $storagePath . ' ' . $nameSlug);
        exec('rm -rf ' . $storagePath . '/' . $nameSlug);

    }

    public function getOnboardingDataArch(Request $request)
    {

        // create excel sheet
        $this->createSpredsheet($request->id);

        $company = Comp::where('id', $request->id)->first();
        $nameSlug = \Str::slug($company->name);
        $filename = 'onboarding-' . $nameSlug . '.zip';

        return response()->download(storage_path("app/onboarding/{$filename}"));
    }


    /**
     * test confFieldFunc()
     *
     * @param $fields
     * @param $id
     */
    private function testFieldsfunc($fields, $id)
    {

        $data = FinInfo::select(array_keys($fields['financial_information']))->where('company_id', $id)->first();
        // $data = CardDetails::select(array_keys($fields['giftcard_details']))->where('company_id', $id)->first();
        //$data = MarketingMaterial::select(array_keys($fields['marketing_material']))->where('company_id', $id)->first();


        /* echo "<pre>";
         print_r($data);
         echo "</pre>";
         die();*/
        foreach ($data->toArray() as $key => $value)
        {
            echo $key;
            echo " --> ";

            echo $this->confFieldFunc($key, $value);

            echo "<br>";
        }


    }


    /**
     * Replace / Format Values for Excel
     *
     * @param $_fieldame
     * @param $_value
     * @return mixed|string
     */
    private function confFieldFunc($_fieldame, $_value)
    {
        $retVal = $_value;


        $guarded = ['redeem_per_trans'];

        if (in_array($_fieldame, $guarded))
        {
            return $_value;
        }

        if ($_fieldame == 'validity_starts_from')
        {

            if ($_value == "9")
            {
                $retVal = $this->getYN(9);
            }

        }
        // fininf
        if ($_fieldame == 'settlement_mode')
        {


            $retArr['9'] = $this->getYN(9);
            $retArr[1] = 'When supplier redeems on site ';
            $retArr[2] = 'Sold by us';

            if (isset($retArr[$_value]))
            {
                return $retArr[$_value];
            }
        }

        //fininf
        if ($_fieldame == 'payment_mode')
        {

            $retArr['9'] = $this->getYN(9);
            $retArr[1] = 'We transfer the money ';
            $retArr[2] = 'You send us an invoice';

            if (isset($retArr[$_value]))
            {
                return $retArr[$_value];
            }

        }


        // --------------------------------------
        /* default */
        if (is_null($_value))
        {
            $_value = 9; // set empty value to 9 will return n/a froom function getYN()
        }

        if (is_int($_value) && strlen($_value) == 1)
        {

            $retVal = $this->getYN($_value);

        }

        if (is_object($_value))
        {

            $retVal = $this->retSelJopt($_value);

            if ($retVal == "")
            {
                $retVal = $this->getYN(9);
            }

        }


        return $retVal;
    }

    /**
     * @param $_val
     * @return mixed
     */
    private function getYN($_val)
    {
        $retVal[9] = 'n/a';
        $retVal[0] = 'No';
        $retVal[1] = 'Yes';

        return $retVal[$_val];
    }


    /**
     * @param $_data
     * @return string
     */
    private function retSelJopt($_data)
    {

        foreach ($_data as $value => $selected)
        {
            if ($selected == 1)
            {
                $retVal[] = $value;
            }
        }

        if (isset($retVal))
        {
            return implode(", ", $retVal);
        }


    }

    /**
     * @param Comp $comp
     * @return mixed
     */
    public function create(Comp $comp)
    {

        $crTime = date('Y-m-d H:i:s', time());
        $company = new $comp;

        $company_id = $company->insertGetId([
                'name' => '',
                'created_at' => $crTime
            ]
        );

        $company->where('id', $company_id)->update(['onboarding_code' => str_random(48)]);


        return \Redirect::to('company/' . $company_id);
    }

    /**
     * Update / Insert
     *
     * @param Comp $company
     * @param FinInfo $finInfo
     * @param CardDetails $details
     * @return mixed
     */
    public function update(Comp $company, Fininfo $finInfo, CardDetails $cardDetails, MarketingMaterial $marketing)
    {

        $data = Input::all();


        // set confirmed to 0 when frontend form is unlocked from backend
        /*        if (!isset($data['fe_captured']) && $data['company']['locked'] == 0)
                {
                    $data['company']['confirmed'] = 0;
                }*/


        // send notification to backend user when customer finishes capturing
        if (Input::get('fe_captured') == 1 && $data['company']['confirmed'])
        {
            $this->sendNotification($data);
            $data['company']['locked'] = 1;

        }

        //-----------------------------------------------------
        // Company / General Information
        $company_id = $data['company_id'];
        $company->where('id', $company_id)->update($data['company']);


        //-----------------------------------------------------
        // financial information
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


            // due to october gubt muttators are not working

            if ($data['fininf']['mod_sales'] == 0)
            {
                $data['fininf']['disc_sales'] = 0.00;
            }
            if ($data['fininf']['mod_engine'] == 0)
            {
                $data['fininf']['disc_engine'] = 0.00;
            }
            if ($data['fininf']['mod_global'] == 0)
            {
                $data['fininf']['disc_global'] = 0.00;
            }


            $finInfo->where('company_id', $company_id)->update($data['fininf']);
        }

        //-----------------------------------------------------
        // gitfcard details
        $isDetails = $cardDetails->where('company_id', $company_id)->count();
        $data['card']['company_id'] = $company_id;

        $data['card']['dist_type'] = json_encode($data['card']['dist_type']);
        $data['card']['dist_site'] = json_encode($data['card']['dist_site']);
        $data['card']['delivery_channel'] = json_encode($data['card']['delivery_channel']);
        $data['card']['card_formats'] = json_encode($data['card']['card_formats']);
        $data['card']['point_of_redeeming'] = json_encode($data['card']['point_of_redeeming']);


        if ($isDetails == 0)
        {
            $data['card']['min_req_val'] = 0.00;
            //$data['card']['pin_chars'] = 0;
            $data['card']['redeem_per_trans'] = 0;
            $data['card']['validity_in_month'] = 0;

            $cardDetails->insert($data['card']);
        }
        else
        {
            $cardDetails->where('company_id', $company_id)->update($data['card']);
        }

        //-----------------------------------------------------
        // contacts
        if (isset($data['contacts']))
        {
            $this->cruContacts($company_id, $data['contacts']);
        }

        //-----------------------------------------------------
        // marketing material

        $isMarketingMaterial = $marketing->where('company_id', $company_id)->count();
        $data['marketing']['company_id'] = $company_id;

        // upload images
        if (isset($data['files']))
        {
            echo "<pre>";
            print_r($data['files']);

            echo "</pre>";


            foreach ($data['files'] as $key => $tmpFile)
            {

                $this->cleanupSf($company_id, $key . '_local_path');


                $file = new \System\Models\File;
                $file->data = $tmpFile;
                $file->is_public = false;
                $file->save();


                //https://octobercms.com/forum/post/deleting-attachments-when-deleting-model
                /*echo \Config::get('cms.storage.uploads.path');
                echo "<pre>";
                print_r($file);
                echo "</pre>";
                die();*/
                // Attach the uploaded file to your model
                $marketing->$key()->add($file);

                // The above line assumes you have proper attachOne or attachMany relationships defined on your model - in this case, I have named the relationship simply as "file"
                $data['marketing'][$key] = $marketing->$key->getPath();
                $data['marketing'][$key . '_local_path'] = $marketing->$key->getLocalPath();
                $data['marketing'][$key . '_org_name'] = $file->getOriginal('file_name');


            }

        }


        if ($isMarketingMaterial == 0)
        {
            $marketing->insert($data['marketing']);
        }
        else
        {
            $marketing->where('company_id', $company_id)->update($data['marketing']);
        }


        return \Redirect::back();

    }

    /**
     * @param $data
     */
    private function sendNotification($data)
    {

        $dataFilled['name'] = $data['company']['name'];


        \Mail::sendTo('tobias@mmsetc.de', 'eq3w.onboarding::mail.capturing_complete', $dataFilled, function ($message) {
            $message->from('noreply@gogift.com', 'gogift.com');
            $message->subject('Customer submitted all required information');
            $message->replyTo('noreply@gogift.com');
        }
        );
    }

    /**
     * Cleanup local storage and system file table
     *
     * @param $_company_id
     * @param $_cuFile
     */
    private
    function cleanupSf($_company_id, $_cuFile)
    {

        $mm = MarketingMaterial::select($_cuFile)->where('company_id', $_company_id)->firstOrFail();

        exec('rm ' . $mm->$_cuFile);

        $disknameTmp = explode('/', $mm->$_cuFile);
        $diskname = end($disknameTmp);

        \System\Models\File::where('disk_name', $diskname)->delete();

    }

//-----------------------------------------------------
    function bulkdummies()
    {
        Test::prep();

    }


    /**
     * Create and update contacts
     *
     * @param $company_id
     * @param $contacts
     */
    private
    function cruContacts($company_id, $contacts)
    {

        foreach ($contacts as $contacts_id => $contact)
        {

            if ($contacts_id === 0)
            {
                $contact['company_id'] = $company_id;

                Contact::insert($contact);
            }
            elseif (is_numeric($contacts_id))
            {
                Contact::where('id', $contacts_id)->update($contact);

                if ($contact['type'] == 999)
                {
                    Contact::where('id', $contacts_id)->delete();
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public
    function getCountries()
    {

        return Helper::getCountries();

    }

    /**
     * Get all available Contact Types
     *
     * @return mixed
     */
    public
    function contactTypes()
    {

        $types = ContactTypes::get();

        return $types;
    }

    /**
     * Add new Contact
     *
     * @return mixed
     */
    public
    function addContact()
    {
        $data = Input::all();
        $company_id = $data['company_id'];

        $this->cruContacts($company_id, $data['contacts']);

        return \Redirect::back();
    }


    /**
     * @param $end_column
     * @param string $first_letters
     * @return array
     */
    function createColumnsArray($end_column, $first_letters = '')
    {
        $columns = array();
        $length = strlen($end_column);
        $letters = range('A', 'Z');

        // Iterate over 26 letters.
        foreach ($letters as $letter)
        {
            // Paste the $first_letters before the next.
            $column = $first_letters . $letter;

            // Add the column to the final array.
            $columns[] = $column;

            // If it was the end column that was added, return the columns.
            if ($column == $end_column)
            {
                return $columns;
            }
        }

        // Add the column children.
        foreach ($columns as $column)
        {
            // Don't itterate if the $end_column was already set in a previous itteration.
            // Stop iterating if you've reached the maximum character length.
            if (!in_array($end_column, $columns) && strlen($column) < $length)
            {
                $new_columns = createColumnsArray($end_column, $column);
                // Merge the new columns which were created with the final columns array.
                $columns = array_merge($columns, $new_columns);
            }
        }

        return $columns;
    }

    /**
     * @param $fieles
     * @param $model
     */
    function fileupload($fieles, $model)
    {
        die();
        $file = new \System\Models\File;
        $file->data = \Input::file('file-upload');
        $file->save();

    }


    /**
     * Output Message translation to put in .Yaml
     *
     *
     */
    private
    function messageTranslationForYaml()
    {
        $msg = DB::table('rainlab_translate_messages')->get();

        foreach ($msg as $key => $item)
        {

            echo $item->code . ": '";
            $mdata = json_decode($item->message_data);


            if (isset($mdata->en))
            {
                echo $mdata->en;
            }
            else
            {
                echo $mdata->x;

            }

            echo "'<br>";
        }
    }

    /**
     * TEST
     *
     * IN VIEW :
     *
     *
     * {{ form_open({files: true, request: 'onFileUpload'}) }}
     *
     * <!--File Input-->
     * <input type="file" name="file-upload" required="required">
     * <!--File Input-->
     *
     * <!--Submit/Upload Button-->
     * <button type="submit">Upload</button>
     *
     * {{ form_close() }}
     *
     * @return mixed
     */
    public
    function onFileUpload()
    {
        die();

        $faker = Faker\Factory::create('es_ES'); // create a French faker


        $model = MarketingMaterial::where('company_id', 11)->first();

        /*
        $model->company_id = 11;
        $model->slogan = $faker->realText(200, 2);
        $model->about = $faker->streetName;
        $model->practical_info = $faker->streetName;
        $model->customer_text = $faker->streetName;
        $model->customer_info = $faker->streetName;
        $model->customer_text = $faker->streetName;
        $model->remark = $faker->streetName;
        */
        /*
        $data['company_id'] = 11;
        $data['slogan'] = $faker->realText(200, 2);
        $data['about'] = $faker->streetName;
        $data['practical_info'] = $faker->streetName;
        $data['customer_text'] = $faker->streetName;
        $data['customer_info'] = $faker->streetName;
        $data['customer_text'] = $faker->streetName;
        $data['remark'] = $faker->streetName;
        */
        $file = new \System\Models\File;
        $file->data = \Input::file('file-upload');
        $file->save();


        // Attach the uploaded file to your model
        $model->file()->add($file);
        // The above line assumes you have proper attachOne or attachMany relationships defined on your model - in this case, I have named the relationship simply as "file"

        $model->companylogo = $model->file->getPath();
        $model->save();

        return \Redirect::back();
    }

    function onRun()
    {
        $this->addJs('/plugins/eq3w/onboarding/assets/javascript/plugin.js?cb=' . time());
        $this->addCss('/plugins/eq3w/onboarding/assets/css/plugin.css?cb=' . time());
    }
}
