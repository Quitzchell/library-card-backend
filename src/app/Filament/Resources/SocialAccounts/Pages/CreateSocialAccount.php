<?php

namespace App\Filament\Resources\SocialAccounts\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\SocialAccounts\SocialAccountResource;
use App\Models\SocialAccount;
use Filament\Resources\Pages\CreateRecord;

class CreateSocialAccount extends CreateRecord
{
    use TriggersRevalidation;

    protected static string $resource = SocialAccountResource::class;

    protected function revalidationKey(): string
    {
        return SocialAccount::class;
    }
}
