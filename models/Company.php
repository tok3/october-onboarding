<?php namespace Eq3w\Onboarding\Models;

use Model;

/**
 * Model
 */
class Company extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    public $timestamps = false;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'eq3w_onboarding_companies';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];


    public $hasOne = [
        'fininfo' => 'Eq3w\Onboarding\Models\FinInfo', 'key' => 'company_id',
        'giftcard' => 'Eq3w\Onboarding\Models\CardDetails', 'key' => 'company_id',
        'marketing' => 'Eq3w\Onboarding\Models\MarketingMaterial', 'key' => 'company_id'

    ];

    public $hasMany = [
        'contacts' => 'Eq3w\Onboarding\Models\Contact', 'key' => 'id', 'otherKey' => 'company_id'

    ];


}
