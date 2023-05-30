@extends('layouts.admin')

@section('page-title', 'Technologies')

@section('content')
  
  <h2 class="fs-4 text-secondary mt-4">Technologies used</h2>

  <table class="table table-striped my-4">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Number of projects</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $technologies as $technology )
      <tr>
        <td>{{$technology->id}}</td>
        <td>{{$technology->name}}</td>
        <td>{{count($technology->projects)}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection