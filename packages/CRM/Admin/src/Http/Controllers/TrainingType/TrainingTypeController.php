<?php

namespace CRM\Admin\Http\Controllers\TrainingType;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use CRM\Training\Repositories\TrainingTypeRepository;

class TrainingTypeController extends Controller
{
    /**
     * Person repository instance.
     *
     * @var \Webkul\Contact\Repositories\PersonRepository
     */
    protected $trainingTypeRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Contact\Repositories\PersonRepository  $trainingTypeRepository
     *
     * @return void
     */
    public function __construct(TrainingTypeRepository $trainingTypeRepository)
    {
        $this->trainingTypeRepository = $trainingTypeRepository;

        request()->request->add(['entity_type' => 'training_types']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(\CRM\Admin\DataGrids\TrainingType\TrainingTypeDataGrid::class)->toJson();
        }

        return view('admin::training.training_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::training.training_type.create');
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

        $person = $this->trainingTypeRepository->create(request()->all());

        Event::dispatch('contacts.person.create.after', $person);

        session()->flash('success', trans('admin::app.contacts.training_type.create-success'));

        return redirect()->route('admin.training_types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $person = $this->trainingTypeRepository->findOrFail($id);

        return view('admin::contacts.persons.edit', compact('person'));
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

        $person = $this->trainingTypeRepository->update($this->sanitizeRequestedPersonData(), $id);

        Event::dispatch('contacts.person.update.after', $person);

        session()->flash('success', trans('admin::app.contacts.persons.update-success'));

        return redirect()->route('admin.contacts.persons.index');
    }

    /**
     * Search person results.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $results = $this->trainingTypeRepository->findWhere([
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
        $person = $this->trainingTypeRepository->findOrFail($id);

        try {
            Event::dispatch('contacts.person.delete.before', $id);

            $this->trainingTypeRepository->delete($id);

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

            $this->trainingTypeRepository->delete($personId);

            Event::dispatch('contact.person.delete.after', $personId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.contacts.persons.title')])
        ]);
    }
}
