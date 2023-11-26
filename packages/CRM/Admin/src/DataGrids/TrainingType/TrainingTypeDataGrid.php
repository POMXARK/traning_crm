<?php

namespace CRM\Admin\DataGrids\TrainingType;

use Illuminate\Support\Facades\DB;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Webkul\UI\DataGrid\DataGrid;

class TrainingTypeDataGrid extends DataGrid
{
    use ProvideDropdownOptions;

    /**
     * Export option.
     *
     * @var boolean
     */
    protected $export;

    /**
     * Create datagrid instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->export = bouncer()->hasPermission('contacts.persons.export') ? true : false;
    }

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('training_types')
            ->addSelect(
                'training_types.id',
                'training_types.title as training_types_title',
                'training_types.description',
                'training_types.number_approaches',
                'training_types.number_repetitions',
                'training_types.approach_time',
                'training_types.pause_time',
            );

        $this->addFilter('id', 'persons.id');
        $this->addFilter('training_types_title', 'training_types.title');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'    => 'training_types_title',
            'label'    => trans('admin::app.datagrid.title'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'      => 'description',
            'label'      => trans('admin::app.datagrid.description'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'number_approaches',
            'label'      => trans('admin::app.datagrid.number_approaches'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'number_repetitions',
            'label'      => trans('admin::app.datagrid.number_repetitions'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'approach_time',
            'label'      => trans('admin::app.datagrid.approach_time'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'pause_time',
            'label'      => trans('admin::app.datagrid.pause_time'),
            'type'       => 'string',
            'sortable'   => true,
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.training_types.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.training_types.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => trans('admin::app.contacts.persons.person')]),
            'icon'         => 'trash-icon',
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('ui::app.datagrid.delete'),
            'action' => route('admin.training_types.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}
