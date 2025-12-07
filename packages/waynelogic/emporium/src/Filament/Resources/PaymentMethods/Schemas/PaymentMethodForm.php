<?php

namespace Waynelogic\Emporium\Filament\Resources\PaymentMethods\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleDefault;
use Waynelogic\Emporium\Models\PaymentMethod;

class PaymentMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        $arProviders = self::getPaymentProviders();

        return $schema->components([
            Section::make('Основное')->schema([
                TextInput::make('name')
                    ->label('Название')
                    ->prefixIcon('heroicon-o-tag')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('code', Str::slug($state)) : null),
                TextInput::make('code')
                    ->label('Код')
                    ->prefixIcon('heroicon-o-link')
                    ->dehydrated()
                    ->maxLength(255)
                    ->unique(PaymentMethod::class, 'code', ignoreRecord: true),
                ToggleActive::make(),
                ToggleDefault::make(),
            ])->columnSpanFull()->columns(2),

            Select::make('provider')
                ->label('Провайдер')
                ->options($arProviders)
                ->hidden($arProviders === []),
            Textarea::make('preview_text')
                ->label('Короткое опписание')
                ->columnSpanFull(),
            RichEditor::make('description')
                ->label('Описание')
                ->columnSpanFull(),
            TextInput::make('svg-icon')
                ->label('SVG иконка'),
        ]);
    }

    private static function getPaymentProviders()
    {
        return [];
    }
}
