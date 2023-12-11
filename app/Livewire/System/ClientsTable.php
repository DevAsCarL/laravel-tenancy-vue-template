<?php

namespace App\Livewire\System;

use App\Models\System\Client;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ClientsTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Client::query()->with('plan');
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableAttributes([
                'class' => 'mx-auto',
            ])
            ->setTdAttributes(function (Column $column) {
                if ($column->getTitle() === 'Monto') {
                    return [
                        'class' => 'text-center',
                    ];
                }
                return [];
            });
    }
    public function columns(): array
    {
        return [
            Column::make('Hostname', 'hostname.fqdn')
                ->sortable()
                ->searchable(),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),
            Column::make('RUC', 'number')
                ->sortable()
                ->searchable(),
            Column::make('Plan', 'plan.name')
                ->sortable()
                ->searchable(),
            Column::make('Fecha de inicio Plan', 'plan_start_date')
                ->sortable()
                ->searchable(),
            Column::make('Monto', 'amount')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('F.creación', 'created_at')
                ->sortable()
                ->searchable()
        ];
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('vendor.rappasoft.livewire-tables.datatable')
            ->with([
                'filterGenericData' => $this->getFilterGenericData(),
                'columns' => $this->getColumns(),
                'rows' => $this->getRows(),
                'customView' => $this->customView(),
            ]);
    }
}
