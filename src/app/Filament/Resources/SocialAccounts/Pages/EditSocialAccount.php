<?php

namespace App\Filament\Resources\SocialAccounts\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\SocialAccounts\SocialAccountResource;
use App\Models\SocialAccount;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSocialAccount extends EditRecord
{
    use TriggersRevalidation;

    protected static string $resource = SocialAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->withRevalidation(DeleteAction::make()),
        ];
    }

    protected function revalidationKey(): string
    {
        return SocialAccount::class;
    }
}
