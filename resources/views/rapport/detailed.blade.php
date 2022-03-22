@extends('rapport.home')

       @section('context')
       <table class="table table-success table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">TIME ENTRY</th>
            <th scope="col">AMOUNT</th>
            <th scope="col">USER</th>
            <th scope="col">TIME</th>
            <th scope="col">DURATION</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($task as $task)
            @foreach ($task->projects()->get() as $proje)
                <tr>
                    <td>
                        @foreach ($projects as $project)
                            @if ($project->id == $proje->id)
                            <input type="text" value="{{$proje->description}}" placeholder=" Description">
                            @endif
                        @endforeach
                    </td>

                    <td>
                        {{$project->name}} - 
                        @foreach ($project->departments()->get() as $depart)
                            {{$depart->dptName}}
                        @endforeach
                        <select>
                            @foreach ($task->categorys()->get() as $category)
                                <option value="">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        ///
                    </td>

                    <td>
                      {{$user->name}}
                    </td>

                    <td></td>
                  
                    <td>{{$task->estimate_time}}</td>
                </tr>  
            @endforeach
            @endforeach       
        </tbody>
      </table>
       @endsection
     
      
{{-- @foreach ($dpt as $department)
<td>
    {{$department->dptName}}
</td>
@endforeach --}}