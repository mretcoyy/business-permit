<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BusinessInformationDetail.
 *
 * @package namespace App\Entities;
 */
class BusinessInformationDetail extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'business_information_detail';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'code',
        'line_of_business',
        'number_of_units',
        'capitalization',
        'essential',
        'non_essential',
        'created_at',
        'updated_at',
    ];

}
