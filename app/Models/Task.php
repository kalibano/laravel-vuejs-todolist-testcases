<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Enums\TaskStatus;
/**
 * Class Task.
 *
 * @package namespace App\Models;
 */
class Task extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'status' => TaskStatus::class
    ];

    public function isPending()
{
    return $this->status === TaskStatus::pending;
}

public function isPublished()
{
    return $this->status === TaskStatus::completed;
}
}
