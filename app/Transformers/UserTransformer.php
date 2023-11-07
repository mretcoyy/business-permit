<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\User;
use App\Enums\UserRole;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param \App\Entities\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name, 
            'email' => $model->email, 
            'username' => $model->username, 
            'role' => $model->role, 
            'role_label' => UserRole::getDescription($model->role),
            'password' => $model->password, 
            'full_address' => $model->full_address, 
            'contact_number' => $model->contact_number, 
            'status' => $model->status, 
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,

        ];
    }
}
