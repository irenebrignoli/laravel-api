@extends('layouts.admin')

@section('page-title', $project->title)

@section('content')
  
<div class="card mt-4 w-75">

  <div class="d-flex">
    <div class="me-2">
      @if($project->image)
      <img class="personal_img_lg" src="{{asset('storage/'. $project->image)}}">
      @else
        <div>
          <img class="personal_img_lg" src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg">
        </div>
      @endif
    </div>
   
    <div>
      <div class="card-body">
        <h5 class="card-title">{{$project->title}}</h5>
        <p class="card-text">{{$project->description}}</p>
      </div>

      <ul class="list-group list-group-flush">
        <li class="list-group-item">Id: {{$project->id}}</li>
        <li class="list-group-item">Type: {{$project->type?$project->type->name:'No project type selected'}}</li>
        <li class="list-group-item">
          <span>Technologies:</span>
          @forelse ($project->technologies as $technology)
            <span class="badge rounded-pill text-bg-success">{{$technology->name}}</span>
          @empty
            <span>No technologies selected</span>
          @endforelse
        </li>
      </ul>
    </div>
  </div>
  
</div>

<a class="btn btn-primary mt-3 me-2" href="{{route('admin.projects.index')}}">Come back to list</a>
<a class="btn btn-outline-warning mt-3"  href="{{route('admin.projects.edit', ['project' => $project->slug])}}">Edit</a>


@endsection