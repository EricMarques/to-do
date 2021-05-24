@extends('layouts.master')
@section('content')

<table>
  <thead>
    <tr>
      <th>Task</th>
      @isAdmin
      <th>Assigned to</th>
      @endisAdmin
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>

  <tbody>
    @foreach($tasks as $task)   
    <tr>
      <td><a href="{{ route('updateStatus', $task->id) }}">
        @if(!$task->status)
        {{ $task->content }}
        @else
        <strike class="grey-text">{{ $task->content }}</strike>
        @endif
      </a></td>
      @isAdmin
      <td>{{ $task->user->name }}</td>
      @endisAdmin
      <td><a title="edit" href="{{ route('edit', $task->id) }}"><i class="material-icons">edit</i></a></td>
      <td><a title="delete" onclick="return confirm('Delete?');" href="{{ route('delete', $task->id) }}"><i class="material-icons red-text">delete_forever</i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $tasks->links('vendor.pagination.materialize') }}

{{--<ul class="pagination">
  <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
  <li class="active"><a href="#!">1</a></li>
  <li class="waves-effect"><a href="#!">2</a></li>
  <li class="waves-effect"><a href="#!">3</a></li>
  <li class="waves-effect"><a href="#!">4</a></li>
  <li class="waves-effect"><a href="#!">5</a></li>
  <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
</ul>--}}
<br><br><br>
<form method="POST" action="{{ route('store') }}" class="col s12">
  <div class="row">
    <div class="input-field col s12">
      <input name="task" id="task" type="text" class="validate">
      <label for="task">New task</label>
    </div>
  </div>

  @include('partials.coworkers')

  <button type="submit" class="waves-effect waves-light btn">Add new task</button>
  @csrf
</form>

@isWorker
<br><br><br>
<form action="" class="col s12">
  <div class="input-field">
    <select>
      <option value="" disabled selected>Send invitation to:</option>
      <option value="2">Buzz McCallister</option>
      <option value="3">Fuller McCallister</option>
      <option value="4">Harry Lime</option>
      <option value="5">Marv Merchants</option>
    </select>
    <label>Send invitation</label>
  </div>
</form>
@endisWorker

@isAdmin
<br><br><br>
<ul class="collection with-header">
  <li class="collection-header"><h4>My coworkers</h4></li>
  <li class="collection-item"><div>Buzz McCallister<a href="#!" class="secondary-content"><i class="material-icons red-text">delete_forever</i></a></div></li>
  <li class="collection-item"><div>Fuller McCallister<a href="#!" class="secondary-content"><i class="material-icons red-text">delete_forever</i></a></div></li>
  <li class="collection-item"><div>Harry Lime<a href="#!" class="secondary-content"><i class="material-icons red-text">delete_forever</i></a></div></li>
  <li class="collection-item"><div>Marv Merchants<a href="#!" class="secondary-content"><i class="material-icons red-text">delete_forever</i></a></div></li>
</ul>
@endisAdmin
@endsection