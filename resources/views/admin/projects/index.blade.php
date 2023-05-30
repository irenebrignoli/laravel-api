@extends('layouts.admin')

@section('page-title', 'Projects')

@section('content')
  
  <h2 class="fs-4 text-secondary mt-4">My projects list</h2>

  <a class="btn btn-primary mt-4"  href="{{route('admin.projects.create')}}">Create  new Project</a>

  <table class="table table-striped my-4">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Image</th>
        <th scope="col">Type</th>
        <th scope="col"class="w-25">Technologies</th>
        {{-- <th scope="col"class="w-25">Description</th> --}}
        <th scope="col">Actions</th>
      </tr>
    </thead>

    <tbody>
      @foreach ( $projects as $project )
      <tr>
        <td>{{$project->id}}</td>
        <td>{{$project->title}}</td>
        <td>
          @if($project->image)
            <img class="personal_img_sm" src="{{asset('storage/'. $project->image)}}">
          @else
            <div>
              <img class="personal_img_sm" src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg">
            </div>
          @endif
        </td>
        <td>{{$project->type?$project->type->name:'No type'}}</td>
        <td>
          @foreach ( $project->technologies as $technology)
           <span class="badge rounded-pill text-bg-success">{{$technology->name}}</span>
          @endforeach
        </td>
        {{-- <td class="text-wrap">{{substr($project->description, 0, 100,)}}...</td> --}}
        <td>

          {{-- action buttons --}}
          <div class="d-flex gap-2">

            <a class="btn btn-outline-primary"  href="{{route('admin.projects.show', ['project' => $project->slug])}}">Show</a>
            <a class="btn btn-outline-warning"  href="{{route('admin.projects.edit', ['project' => $project->slug])}}">Edit</a>
          
            <form class="form_delete_post" action="{{route('admin.projects.destroy', ['project' => $project->slug])}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-dark">Delete</button>
            </form>

          </div>
        
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection