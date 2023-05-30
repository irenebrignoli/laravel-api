@extends('layouts.admin')

@section('page-title', 'Types')

@section('content')
  
  <h2 class="fs-4 text-secondary mt-4">Project types</h2>

  {{-- <a class="btn btn-primary mt-4"  href="{{route('admin.projects.create')}}">Create  new Project</a> --}}

  <table class="table table-striped my-4">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Number of projects</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $types as $type )
      <tr>
        <td>{{$type->id}}</td>
        <td>{{$type->name}}</td>
        <td>{{count($type->projects)}}</td>
        {{-- <td>
          <div class="d-flex gap-3">

            <a class="btn btn-info"  href="{{route('admin.projects.show', ['project' => $project->slug])}}">Show</a>
            <a class="btn btn-warning"  href="{{route('admin.projects.edit', ['project' => $project->slug])}}">Edit</a>
          
            <form class="form_delete_post" action="{{route('admin.projects.destroy', ['project' => $project->slug])}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>

          </div>
        
        </td> --}}
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection