<?php
/**
 * Created by PhpStorm.
 * User: adrianbadarau
 * Date: 11/19/16
 * Time: 7:25 PM
 */

namespace Modules\Cms\Grids;


use Modules\Cms\Entities\Page;
use Yajra\Datatables\Services\DataTable;

class PageIndexGrid extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($item) {
                return '<a href="' . route('page.edit', $item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . " | " . '<a href="' . route('page.destroy', $item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Page::query()->with('author');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->addAction()
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name'=> 'id', 'title' => '#'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Page Title'],
            ['data' => 'author.name', 'name'=>'author.name', 'title' => 'Page author'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pages_' . time();
    }
}