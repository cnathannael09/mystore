@extends('layout.adminlte')
  @section('content')  
<form method="POST" action="{{route('kategori.update',$category->id)}}">
  @csrf
  @method("PUT")
  <div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name" value="{{$category->name}}">
    <small class="form-text text-muted">Please Enter Your Category Name</small>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" rows="3" name="description">{{$category->description}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{route('kategori.index')}}" type="button" class="btn btn-outline-secondary">Cancel</a>
</form>
@endsection