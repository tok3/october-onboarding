<?php namespace Eq3w\Onboarding\Models;

use Model;

/**
 * Model
 */
class FinInfo extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    protected $guarded = ['id'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'eq3w_onboarding_financial_information';

    /**
     * @var array Validation rules
     */
    public $rules = [

    ];


    public function setDiscGlobalAttribute()
    {
        if ($this->attributes['mod_global'] == 0)
        {
            $this->attributes['disc_global'] = 0.00;
        }
    }


    // relations
    public $belongsTo = [
        'company' => ['Eq3w\Onboarding\Models\Company', 'key' => 'company_id', 'otherKey' => 'id']
    ];

}
