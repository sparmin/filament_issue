<?php

namespace App\Filament\Editor\Resources;

use App\Filament\Editor\Resources\UserResource\Pages;
use App\Filament\Editor\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Lab404\Impersonate\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Benutzer';
    protected static ?string $label = 'Benutzer';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Overwrite default function to set label
    public static function getPluralLabel(): ?string
    {
        return 'Benutzer';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required(),
                TextInput::make('email')
                ->email()
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                ->password()
                    ->dehydrated(fn ($state) => filled($state)) // update the password field only when dyhydrated(true)
                    ->nullable()
                    ->autocomplete('new-password')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('created_at')
                ->date(),
                TextColumn::make('updated_at')
                ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
