@extends('layouts.admin')

@section('page-title', "Modifica: $project->title")

@section('content')

    <h2 class="fs-4 text-secondary my-4">Modify project</h2>

    <form method="POST" action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror " id="title" name="title" value="{{old('title', $project->title)}}">
            @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>

            @if ($project->image)
                <div class="position-relative ms_img_wrapper mb-4 ">
                    <img src="{{asset('storage/'. $project->image)}}" class="personal_img_lg d-block">
                    <a href="{{route('admin.projects.deleteImage', ['slug' => $project->slug])}}"class="btn btn-danger position-absolute  top-0 end-0">X</a>
                </div>   
            @endif

            <input type="file" class="form-control @error('image') is-invalid @enderror " id="image" name="image">
            @error('image')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="type_id" class="form-label">Project type:</label>
            <select class="form-select @error('type_id') is-invalid @enderror"  name="type_id" id="type_id">
                <option  @selected(old('type_id', $project->type_id)=='') value="">No project type</option>
                @foreach ( $types as $type)
                    <option  @selected(old('type_id', $project->type_id)==$type->id) 
                    value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3 d-flex ">
            @foreach($technologies as $technology)
            <div class="ms_checkbox px-3">
                @if ($errors->any())
                    <input id="technology_{{$technology->id}}" @if (in_array($technology->id , old('technology', []))) checked @endif type="checkbox" name="technologies[]" value="{{$technology->id}}">
                @else
                    <input id="technology_{{$technology->id}}" @if ($project->technologies->contains($technology->id)) checked @endif type="checkbox" name="technologies[]" value="{{$technology->id}}">
                @endif

                <label for="technology_{{$technology->id}}"  class="form-label">{{$technology->name}}</label>
            </div>
            @endforeach
            @error('technologies')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description', $project->description)}}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary me-2">Modify</button>
        <a class="btn btn-outline-primary" href="{{route('admin.projects.index')}}">Come back to list</a>

    </form>

@endsection