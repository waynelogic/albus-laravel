<?php

namespace Waynelogic\Emporium\Filament\Resources\Organizations\Schemas;


use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleDefault;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Models\Organization;
use Waynelogic\Emporium\Models\Settings\EmporiumSetting;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        $arIdentifiers = self::getIdentifiers();

        return $schema->components([
            Group::make()->schema([

                Section::make('Основное')->schema([
                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon('heroicon-o-tag')
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                        ->required(),
                    TextInput::make('slug')
                        ->label('Слаг')
                        ->prefixIcon('heroicon-o-link')
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(Organization::class, 'slug', ignoreRecord: true),
                ])->columns(2),

                Fieldset::make('Юридическая информация')->schema([
                    TextInput::make('full_name')
                        ->label('Полное название')
                        ->prefixIcon('heroicon-o-building-library')
                        ->maxLength(255),
                    TextInput::make('legal_state')
                        ->label('Юридический статус')
                        ->prefixIcon('heroicon-o-building-library')
                        ->maxLength(255),
                    Group::make([
                        ...$arIdentifiers,
                    ])->statePath('identifiers')
                        ->hidden(fn() => count($arIdentifiers) === 0)
                        ->columnSpanFull()
                        ->columns(2)
                ])->columns(2),
            ])->columnSpan(['lg' => 2]),

            Group::make()->schema([
                Section::make('Дополнительное')->schema([
                    UuidInput::make(),

                    TextInput::make('prefix')
                        ->label('Префикс')
                        ->prefixIcon('heroicon-o-tag')
                        ->maxLength(255),

                    ToggleDefault::make(),
                ]),
            ]),

        ])->columns(['lg' => 3]);
    }

    private static function getIdentifiers(): array
    {
        return collect(EmporiumSetting::get('identifiers', []))
            ->map(fn ($identifier) => TextInput::make($identifier['id'])
                ->label($identifier['name'])
                ->prefixIcon('heroicon-o-tag')
                ->maxLength(255)
            )
            ->all();
    }
}
