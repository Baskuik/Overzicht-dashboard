<?php

namespace App\Filament\Resources\Uploads\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\User;

class UploadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('file_name')
                    ->label('File Name')
                    ->required(),

                DateTimePicker::make('upload_date')
                    ->label('Upload Date')
                    ->default(now())
                    ->required(),
            ]);
    }
}
