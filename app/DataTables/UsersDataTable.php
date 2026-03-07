<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->editColumn('is_aktive', function ($row) {
                return $row->is_aktive ? 'Aktif' : 'Non-Aktif';
            })
            ->addColumn('action', function ($user) {
                return '
                    <a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-warning text-white px-3 rounded" ><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="' . route('users.destroy', $user->id) . '" method="POST" style="display: inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger px-3 rounded" onclick="return confrm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                ';
            })
            ->setRowId('DT_RowIndex');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
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
                Button::make('reload')
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
            Column::make('name')->title('Nama'),
            Column::make('email'),
            Column::make('npm')->title('NPM'),
            Column::make('prodi')->title('Prodi'),
            Column::make('role'),
            Column::make('is_aktive')->title('Status'),
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
        return 'Users_' . date('YmdHis');
    }
}
