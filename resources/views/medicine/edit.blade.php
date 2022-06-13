@extends('layout.adminlte')
  @section('content')  
<form method="POST" action="{{route('obat.store')}}">
  @csrf
  <div class="form-group">
    <label for="name">Generic Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name" value="{{$medicine->generic_name}}">
    <small class="form-text text-muted">Please Enter Your Generic Name</small>
  </div>
  <div class="form-group">
    <label for="form">Form</label>
    <input type="text" class="form-control" id="form" placeholder="Enter Form" name="form" value="{{$medicine->form}}">
  </div>
  <div class="form-group">
    <label for="restriction">Restriction Formula</label>
    <input type="text" class="form-control" id="restriction" placeholder="Enter Restriction Formula" name="restriction" value="{{$medicine->restriction_formula}}">
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price" value="{{$medicine->price}}">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" rows="3" name="description">{{$medicine->description}}</textarea>
  </div>
  <div class="form-group">
    <label for="categoryid">Category Id</label>
    <select class="form-control" id="categoryid" name='categoryid'>
        @foreach($data as $d)
        <option value="{{$d->id}}" 
          @if ({{$d->id}} == {{$medicine->category_id}})
          selected="selected"
          @endif
          >{{$d->id}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="faskes1">Faskes1</label>
    <input type="number" class="form-control" id="faskes1" name="faskes1" min="0" max="1" value="{{$medicine->faskes1}}">
  </div>
  <div class="form-group">
    <label for="faskes2">Faskes2</label>
    <input type="number" class="form-control" id="faskes2" name="faskes2" min="0" max="1" value="{{$medicine->faskes2}}">
  </div>
  <div class="form-group">
    <label for="faskes3">Faskes3</label>
    <input type="number" class="form-control" id="faskes3" name="faskes3" min="0" max="1" value="{{$medicine->faskes3}}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{route('obat.index')}}" type="button" class="btn btn-outline-secondary">Cancel</a>
</form>
@endsection