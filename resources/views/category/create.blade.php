@extends('layout.adminlte')
  @section('content')  
<form enctype="multipart/form-data" role="form" method="POST" action="{{route('kategori.store')}}">
  @csrf
  <div class="form-group">
    <label>Logo</label>
    <input type="file" class="form-control" id='logo' name='logo'>
  </div>
  <div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name">
    <small class="form-text text-muted">Please Enter Your Category Name</small>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{route('kategori.index')}}" type="button" class="btn btn-outline-secondary">Cancel</a>
</form>
@endsection