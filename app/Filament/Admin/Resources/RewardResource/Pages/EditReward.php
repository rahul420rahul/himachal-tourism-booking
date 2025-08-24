<?php

namespace App\Filament\Admin\Resources\RewardResource\Pages;

use App\Filament\Admin\Resources\RewardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReward extends EditRecord
{
    protected static string $resource = RewardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
