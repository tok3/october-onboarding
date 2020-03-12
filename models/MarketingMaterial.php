<?php namespace Eq3w\Onboarding\Models;

use Model;

/**
 * Model
 */
class MarketingMaterial extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'eq3w_onboarding_marketing_material';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];


    public $belongsTo = [
        'company' => ['Eq3w\Onboarding\Models\Company', 'key' => 'company_id', 'otherKey' => 'id']
    ];


    public $attachOne = [
        'file' => 'System\Models\File',
        'moodpicture' => 'System\Models\File',
        'companylogo' => 'System\Models\File',
        'cardimage' => 'System\Models\File'
    ];


    /*
        public function afterSave()
        {
            $filePath = $this->file->getPath();
            Log::info($filePath);
        }*/
}
