<?php

namespace App\Filament\Resources\Records\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('upload_id')
                    ->label('Upload')
                    ->relationship('upload', 'file_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('action')
                    ->label('Action')
                    ->required(),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(3),

                TextInput::make('employee_name')
                    ->label('Employee Name')
                    ->required(),

                TextInput::make('duration')
                    ->label('Duration (minutes)')
                    ->numeric(),

                TextInput::make('cost')
                    ->label('Cost (€)')
                    ->numeric()
                    ->step(0.01),

                DatePicker::make('date')
                    ->label('Date'),
            ]);
    }
}
