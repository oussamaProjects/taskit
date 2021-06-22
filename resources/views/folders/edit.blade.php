@extends('layouts.app')

@section('content')
<div class="row">
    <div class="section">
        <div class="col hide-on-med-and-down">
            @include('inc.sidebar')
        </div>
        <div class="col m11 s12">
            <div class="row">
                <h3 class="flow-text"><i class="material-icons">mode_edit</i> Edit Folder
                    <button data-target="modal1" class="btn waves-effect waves-light modal-trigger right">Add
                        New</button>
                </h3>
                <div class="divider"></div>
            </div>
            {!! Form::open(['action' => ['FolderController@update',$folder->id], 'method' => 'PATCH', 'class' => 'col
            m12']) !!}
            <div class="card z-depth-2">
                <div class="card-content">
                    <div class="row">
                        <div class="col m6 input-field">
                            <i class="material-icons prefix">class</i>
                            {{ Form::text('name', $folder->name, ['class' => 'validate', 'id' => 'folder']) }}
                            <label for="folder">folder Name</label>
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
        <h4>Add folder</h4>
        <div class="divider"></div>
        {!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => 'col s12']) !!}
        <div class="col s12 input-field">
            <i class="material-icons prefix">class</i>
            {{ Form::text('name','',['class' => 'validate', 'id' => 'folder']) }}
            <label for="folder">folder Name</label>
        </div>
    </div>
    <div class="modal-footer">
        {{ Form::submit('submit',['class' => 'btn']) }}
        {!! Form::close() !!}
    </div>
</div>
@endsection