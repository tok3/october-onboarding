<?php namespace Eq3w\Onboarding\Models;

use Model;

/**
 * Model
 */
class ContactTypes extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'eq3w_onboarding_contact_types';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
