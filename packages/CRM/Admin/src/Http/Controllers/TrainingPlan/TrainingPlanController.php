<?php

namespace CRM\Admin\Http\Controllers\TrainingPlan;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use CRM\TrainingPlan\Repositories\TrainingPlanRepository;

class TrainingPlanController extends Controller
{
    /**
     * Person repository instance.
     *
     * @var \Webkul\Contact\Repositories\PersonRepository
     */
    protected $trainingPlanRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Contact\Repositories\PersonRepository  $trainingPlanRepository
     *
     * @return void
     */
    public function __construct(TrainingPlanRepository $trainingPlanRepository)
    {
        $this->trainingPlanRepository = $trainingPlanRepository;

        request()->request->add(['entity_type' => 'training_plan']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(\CRM\Admin\DataGrids\TrainingPlan\TrainingPlanDataGrid::class)->toJson();
        }

        return view('admin::training.training_plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::training.training_plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Webkul\Attribute\Http\Requests\AttributeForm $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeForm $request)
    {
        Event::dispatch('contacts.person.create.before');

        $data = request()->all();
        $currentUser = auth()->guard()->user();
        $data['user_id'] = $currentUser->id;

        $person = $this->trainingPlanRepository->create($data);

        Event::dispatch('contacts.person.create.after', $person);

        session()->flash('success', trans('admin::app.contacts.training_plan.create-success'));

        return redirect()->route('admin.training_plan.index');
    }

    /**
     * Display a resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
//        $call = $this->trainingPlanRepository->join('users', 'users.id', '=', 'calls.user_id')->findOrFail($id);
//
//        $models = $this->trainingPlanRepository->join('users', 'users.id', '=', 'calls.user_id')
//            ->where('client_id', $call->client_id)->get();

//        $history = $models->filter(function ($model) use ($id) {
//            return $model->id != $id;
//        });

//        $currentUser = auth()->guard('user')->user();
//
//        if ($currentUser->view_permission != 'global') {
//            if ($currentUser->view_permission == 'group') {
//                $userIds = app('\Webkul\User\Repositories\UserRepository')->getCurrentUserGroupsUserIds();
//
//                if (! in_array($call->user_id, $userIds)) {
//                    return redirect()->route('admin.calls.index');
//                }
//            } else {
//                if ($call->user_id != $currentUser->id) {
//                    return redirect()->route('admin.calls.index');
//                }
//            }
//        }

//        return view('admin::calls.view',  ['lead' => $call, 'history' => $history]);

        $person = $this->trainingPlanRepository->findOrFail($id)->trainingType()->get()->first();

        return view('admin::training.training_plan.view', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $person = $this->trainingPlanRepository->findOrFail($id);

        return view('admin::training.training_plan.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Webkul\Attribute\Http\Requests\AttributeForm $request
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeForm $request, $id)
    {
        Event::dispatch('contacts.person.update.before', $id);

        $person = $this->trainingPlanRepository->update(request()->all(), $id);

        Event::dispatch('contacts.person.update.after', $person);

        session()->flash('success', trans('admin::app.contacts.persons.update-success'));

        return redirect()->route('admin.training_plan.index');
    }

    /**
     * Search person results.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $results = $this->trainingPlanRepository->findWhere([
            ['name', 'like', '%' . urldecode(request()->input('query')) . '%']
        ]);

        return response()->json($results);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = $this->trainingPlanRepository->findOrFail($id);

        try {
            Event::dispatch('contacts.person.delete.before', $id);

            $this->trainingPlanRepository->delete($id);

            Event::dispatch('contacts.person.delete.after', $id);

            return response()->json([
                'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.contacts.persons.person')]),
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.response.destroy-failed', ['name' => trans('admin::app.contacts.persons.person')]),
            ], 400);
        }
    }

    /**
     * Mass Delete the specified resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        foreach (request('rows') as $personId) {
            Event::dispatch('contact.person.delete.before', $personId);

            $this->trainingPlanRepository->delete($personId);

            Event::dispatch('contact.person.delete.after', $personId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.contacts.persons.title')])
        ]);
    }
}
