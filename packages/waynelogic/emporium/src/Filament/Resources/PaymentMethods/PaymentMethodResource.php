<?php

namespace Waynelogic\Emporium\Filament\Resources\PaymentMethods;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\Pages\CreatePaymentMethod;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\Pages\EditPaymentMethod;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\Pages\ListPaymentMethods;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\Schemas\PaymentMethodForm;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\Tables\PaymentMethodsTable;
use Waynelogic\Emporium\Models\PaymentMethod;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class PaymentMethodResource extends SettingResource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $label = 'Метод оплаты';

    protected static ?string $pluralLabel = 'Методы оплаты';

    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::CreditCard;

    protected static string | null $description = 'Управление методами оплаты';

    public static function form(Schema $schema): Schema
    {
        return PaymentMethodForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentMethodsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentMethods::route('/'),
            'create' => CreatePaymentMethod::route('/create'),
            'edit' => EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
