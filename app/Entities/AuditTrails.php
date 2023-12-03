<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AuditTrails.
 *
 * @package namespace App\Entities;
 */
class AuditTrails extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'audit_trail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'status',
        'business_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function businessDetail()
    {
        return $this->hasMany(BusinessDetail::class, 'business_id', 'business_id')
            ->orderBy('created_at', 'DESC');
    }

    public function businessInformation()
    {
        return $this->hasMany(BusinessInformation::class, 'business_id', 'business_id')
            ->orderBy('created_at', 'DESC');
    }
   
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')
            ->orderBy('created_at', 'DESC');
    }
}
