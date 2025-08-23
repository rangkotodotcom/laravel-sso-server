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
            'id' => Str::upper($this->id),
            'avatar' => create_url_file($data['photo_name'], $data['photo_path']),
        ];

        return $data;
    }
}
