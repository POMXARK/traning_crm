@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.contacts.persons.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.training_plan.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.contacts.persons.index.persons.before') !!}

                    {{ Breadcrumbs::render('training.training_plan') }}

                    {{ __('admin::app.layouts.training_plan') }}

                    {!! view_render_event('admin.contacts.persons.index.persons.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('contacts.persons.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.training_plan.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.training.training_plan.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
