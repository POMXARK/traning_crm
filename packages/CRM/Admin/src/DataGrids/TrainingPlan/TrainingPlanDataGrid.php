<?php

namespace CRM\Admin\DataGrids\TrainingPlan;

use CRM\Training\Repositories\TrainingTypeRepository;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Webkul\UI\DataGrid\DataGrid;

class TrainingPlanDataGrid extends DataGrid
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
        $queryBuilder = DB::table('training_plan')
            ->addSelect(
                'training_plan.id',
                'training_plan.user_id as training_plan_user_id',
                'training_types.name as training_types_name',
                'training_plan.day_week',
                'training_plan.time',
            )
            ->leftJoin('training_types', 'training_plan.training_types_id', '=', 'training_types.id')
            ->leftJoin('users', 'training_plan.user_id', '=', 'users.id');

        $this->addFilter('id', 'training_plan.id');
        $this->addFilter('training_types_name', 'training_types.id');

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
            'index'      => 'training_types_name',
            'label'      => trans('admin::app.training.training_plan.training'),
            'type'             => 'dropdown',
            'dropdown_options' => $this->getDropdownOptions(TrainingTypeRepository::class),
            'sortable'         => true,
        ]);

        $this->addColumn([
            'index'      => 'day_week',
            'label'      => trans('admin::app.datagrid.day_week'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'time',
            'label'      => trans('admin::app.datagrid.time'),
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
            'route'  => 'admin.training_plan.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.training_plan.delete',
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
            'action' => route('admin.training_plan.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}
