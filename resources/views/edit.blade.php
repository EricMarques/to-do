@extends('layouts.master')
@section('content')

<form method="POST" action="{{ route('update', ['id'=>$task->id]) }}" class="col s12" style="margin-bottom: 70px">
	<div class="row">
		<div class="input-field col s12">
			<input name="task" value="{{ $task->content }}" id="{{ $task->id }}" type="text" class="validate">
			<label for="task">Edit task</label>
		</div>
	</div>

	@include('partials.coworkers')

	<button class="waves-effect waves-light btn">Edit task</button>
	@csrf
</form>
@endsection