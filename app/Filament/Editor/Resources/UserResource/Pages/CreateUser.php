<?php

namespace App\Filament\Editor\Resources\UserResource\Pages;

use App\Filament\Editor\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
