@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="section">
            <div class="col hide-on-med-and-down">
                @include('inc.sidebar')
            </div>
            <div class="col m11 s12">
                <div class="row">
                    <h3 class="flow-text">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Department
                        <button data-target="modal1" class="btn waves-effect waves-light modal-trigger right">Add
                            New</button>
                    </h3>
                    <div class="divider"></div>
                </div>
                {!! Form::open(['action' => ['DepartmentsController@update', $dept->id], 'method' => 'PATCH', 'class' => 'col m12']) !!}
                <div class="card z-depth-1">
                    <div class="card-content">
                        <div class="row">
                            <div class="col m6 input-field">
                                <i class="material-icons prefix">class</i>
                                {{ Form::text('dptName', $dept->dptName, ['class' => 'validate', 'id' => 'department']) }}
                                <label for="department">Department Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 input-field">
                                {{ Form::submit('Save Changes', ['class' => 'btn waves-effect waves-light']) }}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Add Department</h4>
            <div class="divider"></div>
            <div class="row">
                {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
                <div class="input-field">
                    {{ Form::text('dptName', '', ['class' => 'validate', 'id' => 'dptName']) }}
                    <label for="dptName">Department Name</label>
                </div>
                <div class="input-field">
                    {{ Form::submit('Submit', ['class' => 'btn waves-effect waves-light']) }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
