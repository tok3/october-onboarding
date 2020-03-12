<?php namespace Eq3w\Onboarding\Models;

use Model;

/**
 * Model
 */
class CardDetails extends Model
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
    public $table = 'eq3w_onboarding_gifcard_details';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];


    private function toDec($value)
    {

        return 0.00;
        if ($value === "")
        {
            $value = 0.00;
        }

        return $value;
    }

    /**
     * @param $value
     */
    public function setMinReqValAttribute($value)
    {

        $value = $this->toDec($value);

        $this->attributes['min_req_val'] = strtolower($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getDistTypeAttribute($value)
    {

        return json_decode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setDistTypeAttribute($value)
    {

        $this->attributes['dist_type'] = json_encode($value);
    }


    /**
     * @param $value
     * @return mixed
     */
    public function getDistSiteAttribute($value)
    {

        return json_decode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setDistSiteAttribute($value)
    {

        $this->attributes['delivery_channel'] = json_encode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getDeliveryChannelAttribute($value)
    {

        return json_decode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setDeliveryChannelAttribute($value)
    {

        $this->attributes['delivery_channel'] = json_encode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getCardFormatsAttribute($value)
    {

        return json_decode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setCardFormatsAttribute($value)
    {

        $this->attributes['card_formats'] = json_encode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPointOfRedeemingAttribute($value)
    {

        return json_decode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPointOfRedeemingAttribute($value)
    {

        $this->attributes['point_of_redeeming'] = json_encode($value);
    }


    public $belongsTo = [
        'company' => ['Eq3w\Onboarding\Models\Company', 'key' => 'company_id', 'otherKey' => 'id']
    ];
}
