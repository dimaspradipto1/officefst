<?php

namespace App\DataTables;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MahasiswaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder<Mahasiswa>  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('action', function ($item) {
                return '
                   <a href="' . route('mahasiswa.edit', $item->id) . '" class="btn btn-sm btn-warning text-white rounded me-2" title="edit">
                             <i class="fa-solid fa-pen-to-square"></i>
                         </a>
                         <form action="' . route('mahasiswa.destroy', $item->id) . '" method="POST" class="d-inline">
                             ' . csrf_field() . '
                             ' . method_field('delete') . '
                             <button type="submit" class="btn btn-danger btn-sm" title="hapus">
                                 <i class="fa-solid fa-trash-can"></i>
                             </button>
                         </form>
                ';
            })
            ->setRowId('DT_RowIndex');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Mahasiswa>
     */
    public function query(Mahasiswa $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('mahasiswa-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No'),
            Column::make('npm')
                ->title('NPM'),
            Column::make('name')
                ->title('Nama Mahasiswa'),
            Column::make('email')
                ->title('Email UIS'),
            Column::make('nohp')
                ->title('Nomor Whatsapp'),
            Column::make('prodi')
                ->title('Program Studi'),
            Column::computed('action')
                ->title('AKSI')
                ->exportable(false)
                ->printable(false)
                ->width('15%')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Mahasiswa_' . date('YmdHis');
    }
}
