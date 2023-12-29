<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return[
            'Al1' => Tab::make(),
            'Today' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('date_hired', '>=', now()->subDay()))
            ->badge(Employee::query()->where('date_hired', '>=', now()->subDay())->count()),
            'This Week' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('date_hired', '>=', now()->subWeek()))
            ->badge(Employee::query()->where('date_hired', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('date_hired', '>=', now()->subMonth()))
            ->badge(Employee::query()->where('date_hired', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query)=>$query->where('date_hired', '>=', now()->subMonth()))
            ->badge(Employee::query()->where('date_hired', '>=', now()->subDay())->count()),
        ];
    }
}
