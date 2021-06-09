@extends('layouts.master')
@section('content')

<table>
  <thead>
    <tr>
      <th>Task</th>
      @isAdmin
      <th>Assigned to</th>
      <th>Created at</th>
      <th>Updated at</th>
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
      <td>{{ $task->created_at->format('d/m/Y  H:i:s') }}</td>
      <td>{{ $task->updated_at->format('d/m/Y  H:i:s') }}</td>
      @endisAdmin
      <td><a title="edit" href="{{ route('edit', $task->id) }}"><i class="material-icons">edit</i></a></td>
      <td><a title="delete" onclick="return confirm('Delete?');" href="{{ route('delete', $task->id) }}"><i class="material-icons red-text">delete_forever</i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $tasks->links('vendor.pagination.materialize ') }}

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
<form method="POST" action="{{ route('sendInvitation') }}" class="col s12">
  <div class="input-field">
    <select name="admin">
      <option value="" disabled selected>Send invitation to:</option>
      @foreach($coworkers as $coworker)
        <option value="{{ $coworker->id }}">{{ $coworker->name }}</option>
      @endforeach
    </select>
    <label>Send invitation</label>
  </div>
  <button type="submit" class="waves-effect waves-light btn">Send Invitation</button>
  @csrf
</form>
@endisWorker

@isAdmin
<br><br><br>
<ul class="collection with-header">
  <li class="collection-header"><h4>My coworkers</h4></li>
  @foreach($coworkers as $coworker)
    <li class="collection-item"><div>{{ $coworker->worker->name }}
        <a href="{{ route('deleteWorker', $coworker->id) }}" class="secondary-content">
          <i class="material-icons red-text">delete_forever</i>
        </a>
      </div>
    </li>  
  @endforeach
</ul>
@endisAdmin
@endsection