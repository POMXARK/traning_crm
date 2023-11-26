@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.contacts.persons.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.training_types.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.contacts.persons.index.persons.before') !!}

                    {{ Breadcrumbs::render('training.training_types') }}

                    {{ __('admin::app.layouts.training_types') }}

                    {!! view_render_event('admin.contacts.persons.index.persons.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('contacts.persons.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.training_types.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.training.training_types.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
