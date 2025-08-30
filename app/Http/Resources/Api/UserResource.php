<?php

namespace App\Http\Resources\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        $data = [
            ...$data,
            'id'                => Str::upper($this->id),
            'name'              => Str::upper($this->name),
            'nickname'          => Str::slug($this->name),
            'avatar'            => create_url_file($data['photo_name'], $data['photo_path']),
            'created_at_str'    => date_time_str('DD MMMM Y HH:mm', $this->created_at),
            'updated_at_str'    => date_time_str('DD MMMM Y HH:mm', $this->updated_at),
            'deleted_at_str'    => date_time_str('DD MMMM Y HH:mm', $this->deleted_at),
        ];

        return $data;
    }
}
