<?php
namespace App\Http\Resources;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskListResource extends JsonResource
{
    public function toArray($request)
    {
         return TaskResource::collection($this);
        
    }
}