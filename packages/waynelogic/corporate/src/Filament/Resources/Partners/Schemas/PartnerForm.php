<?php

namespace Waynelogic\Corporate\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Waynelogic\Corporate\Enums\PartnerType;
use Waynelogic\Corporate\Models\Partner;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make([
                Section::make('Основное')->schema([

                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon(Heroicon::OutlinedTag)
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    TextInput::make('slug')
                        ->label('Ссылка')
                        ->prefixIcon(Heroicon::OutlinedLink)
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(Partner::class, 'slug', ignoreRecord: true),
                ])->compact()->columns(2)->columnSpanFull(),

                Textarea::make('preview_text')
                    ->label('Корткое описание')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Контент')
                    ->columnSpanFull(),
            ])->columns(2)->columnSpan(['lg' => 2]),

            Section::make('Параметры')->schema([
                Toggle::make('is_active')
                    ->label('Активность')
                    ->onIcon(Heroicon::OutlinedPower)
                    ->default(true)
                    ->required(),
                Select::make('type')
                    ->label('Тип')
                    ->prefixIcon(Heroicon::OutlinedBuildingLibrary)
                    ->options(PartnerType::class)
                    ->default('partner')
                    ->native(false)
                    ->required(),
                TextInput::make('web_site')
                    ->label('Веб-сайт')
                    ->prefixIcon(Heroicon::OutlinedGlobeAlt),
                SpatieMediaLibraryFileUpload::make('logo')
                    ->label('Логотип')
                    ->collection('partners_logos')
                    ->image(),
            ])->compact(),

        ])->columns(['lg' => 3]);
    }
}
