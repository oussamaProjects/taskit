@extends('rapport.home')
@section('context')
<table class="table table-success table-striped">
    <thead>
      <tr>
        <th scope="col">TIME ENTRY</th>
        <th scope="col">AMOUNT</th>
        <th scope="col">USER</th>
        <th scope="col">TIME</th>
        <th scope="col">DURATION</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($task as $task)
        <tr>
            <td>
                @foreach ($task->projects()->get() as $project)
                    {{$project->name}}
                @endforeach
            </td>
        
            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>   
    @endforeach   
    </tbody>
  </table>
@endsection