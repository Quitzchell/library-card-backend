<?php

namespace App\Filament\Concerns;

use App\Services\Revalidation;
use Filament\Actions\Action;

trait TriggersRevalidation
{
    abstract protected function revalidationKey(): string;

    protected function afterCreate(): void
    {
        Revalidation::triggerFor($this->revalidationKey());
    }

    protected function afterSave(): void
    {
        Revalidation::triggerFor($this->revalidationKey());
    }

    protected function withRevalidation(Action $action): Action
    {
        $key = $this->revalidationKey();

        return $action->after(fn () => Revalidation::triggerFor($key));
    }
}
