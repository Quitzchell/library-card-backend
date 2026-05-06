<?php

namespace App\Filament\Resources\Videos\Pages;

use App\Enums\VideoType;
use App\Filament\Resources\Videos\VideoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        foreach (VideoType::cases() as $type) {
            $tabs[$type->value] = Tab::make($type->label())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('category', $type->value));
        }

        return $tabs;
    }
}
