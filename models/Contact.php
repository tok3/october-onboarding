<?php namespace Eq3w\Onboarding\Models;

use Model;

/**
 * Model
 */
class Contact extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    public $timestamps = false;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'eq3w_onboarding_contacts';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'company' => 'Eq3w\Onboarding\Models\Company' , 'key' => 'company_id'

    ];
}
