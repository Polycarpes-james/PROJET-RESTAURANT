<?php

namespace App\Data\User;

use App\Models\User;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $firstname,
        public string $email,
        public ?string $avatar,
        public string $role,
    ) {}


    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            username: $user->name,
            email: $user->email,
            createdAt: $user->created_at,
            avatar: image_url($user->avatar, 300, 300),
            role: $user->role_label
        );
    }
}

