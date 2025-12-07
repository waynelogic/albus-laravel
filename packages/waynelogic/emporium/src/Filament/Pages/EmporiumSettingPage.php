<?php

namespace Waynelogic\Emporium\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Models\Settings\EmporiumSetting;
use Waynelogic\Emporium\Models\Unit;
use Waynelogic\FilamentCms\System\Filament\EditSetting;

class EmporiumSettingPage extends EditSetting
{
    protected string $model = EmporiumSetting::class;

    protected static ?string $title = 'Настройки продукта';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::ShoppingBag;

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('tabs')->tabs([
                Tabs\Tab::make('Настройки создания')->schema([
                    Select::make('default_dimension_unit_id')
                        ->label('Единица измерения размера по умолчанию')
                        ->options(Unit::pluck('name', 'id')),
                    Select::make('default_weight_unit_id')
                        ->label('Единица измерения веса по умолчанию')
                        ->options(Unit::pluck('name', 'id')),
                ])->columns(2),

                Tabs\Tab::make('Организации')->schema([
                    Repeater::make('identifiers')->schema([
                        TextInput::make('name')
                            ->label('Название поля')
                            ->prefixIcon(Heroicon::OutlinedTag)
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $set('id', Str::slug($state))),
                        TextInput::make('id')
                            ->label('ID поля')
                            ->prefixIcon(Heroicon::OutlinedLink)
                            ->dehydrated()
                            ->maxLength(255)
                            ->rules([
                                'regex:/^[a-zA-Z0-9_-]+$/'
                            ])
                            ->validationMessages([
                                'regex' => 'Идентификатор может состоять только из букв, цифр, символов подчеркивания и тире.'
                            ])
                            ->required(),
                    ])->label('Идентификаторы')->columns(2),
                ])
            ])->columnSpanFull(),
        ]);
    }
}
