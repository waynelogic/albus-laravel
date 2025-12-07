<?php

namespace Waynelogic\Emporium\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Waynelogic\Emporium\Models\Product;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make([
                TextInput::make('name')
                    ->label('Имя')
                    ->required(),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email(),
                Select::make('user_id')
                    ->label('Пользователь')
                    ->relationship('user', 'name')
                    ->searchable(),

                TextInput::make('rating')
                    ->label('Рейтинг')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5),
                Textarea::make('message')
                    ->label('Сообщение')
                    ->required()
                    ->columnSpanFull(),
            ])->columnSpan(['lg' => 2])->columns(2),
            Group::make([
                MorphToSelect::make('reviewable')
                    ->label('Объект')
                    ->types([
                        MorphToSelect\Type::make(Product::class)
                            ->label('Товар')
                            ->titleAttribute('name'),
                    ])->columns(1),
                Toggle::make('is_approved')
                    ->label('Одобрено')
                    ->required(),
                TextEntry::make('read_at')
                    ->label('Прочитано'),
            ]),
        ])->columns(['lg' => 3]);
    }
}
