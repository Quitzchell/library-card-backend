<?php

namespace App\Filament\Pages;

use App\Filament\Forms\Components\OptimizedImageUpload;
use App\Services\Revalidation;
use App\Settings\BiographySettings;
use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;

class ManageBiography extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|\UnitEnum|null $navigationGroup = 'General';

    protected static string $settings = BiographySettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Biography')
                    ->schema(components: [
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('text')
                            ->required()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                ['h2', 'h3'],
                                ['alignStart', 'alignCenter', 'alignEnd'],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ])
                            ->extraInputAttributes(['style' => 'min-height: 18rem'])
                            ->columnSpanFull(),
                        Repeater::make('images')
                            ->label('Images')
                            ->schema([
                                OptimizedImageUpload::make('path')
                                    ->directory('biography')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('alt')
                                    ->label('Alt text')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                            ])
                            ->reorderable()
                            ->collapsed()
                            ->itemLabel(fn (array $state): ?string => $state['alt'] ?? null)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $previous = collect(app(BiographySettings::class)->images ?? [])
            ->pluck('path')
            ->filter()
            ->all();
        $current = collect($data['images'] ?? [])
            ->pluck('path')
            ->filter()
            ->all();
        $orphans = array_diff($previous, $current);

        foreach ($orphans as $path) {
            Storage::disk(config('images.disk'))->delete($path);
        }

        $data['images'] = array_values($data['images'] ?? []);

        return $data;
    }

    protected function afterSave(): void
    {
        Revalidation::triggerFor(BiographySettings::class);
    }
}
