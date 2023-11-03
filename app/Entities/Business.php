<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Business.
 *
 * @package namespace App\Entities;
 */
class Business extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'business';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reference_number',
        'dti_registration_no',
        'dti_date_of_registration',
        'type_of_organization',
        'is_tax_incentive',
        'date_of_application',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function businessDetail()
    {
        return $this->hasMany(BusinessDetail::class, 'business_id', 'id')
            ->orderBy('created_at', 'DESC');
    }

    public function businessInformation()
    {
        return $this->hasMany(BusinessInformation::class, 'business_id', 'id')
            ->orderBy('created_at', 'DESC');
    }

    public function businessInformationDetail()
    {
        return $this->hasMany(BusinessInformationDetail::class, 'business_id', 'id')
            ->orderBy('created_at', 'DESC');
    }

    public function lessorInformation()
    {
        return $this->hasMany(LessorInformation::class, 'business_id', 'id')
            ->orderBy('created_at', 'DESC');
    }

    public function OwnerInformation()
    {
        return $this->hasMany(OwnerInformation::class, 'business_id', 'id')
            ->orderBy('created_at', 'DESC');
    }

    public function businessFiles()
    {
        return $this->hasMany(BusinessFiles::class, 'business_id', 'id')
            ->orderBy('created_at', 'DESC');
    }
}
