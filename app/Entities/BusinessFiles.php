<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BusinessFiles.
 *
 * @package namespace App\Entities;
 */
class BusinessFiles extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'barangay_clearance',
        'zoning_clearance',
        'sanitary_clearance',
        'occupancy_permit',
        'environment_certificate',
        'community_tax_certificate',
        'real_property_tax_clearance',
        'fire_certificate',
        'created_at',
        'updated_at'
    ];

}
