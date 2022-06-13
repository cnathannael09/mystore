@extends('layout.adminlte')
  @section('content')  
<div class="container">
  <div class="page-content">
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}
      </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error')}}
    </div>
    @endif

  </div>
  <h2>List Products</h2>
  <p>Berikut adalah daftar Produk:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Form</th>
        <th>Restriction Formula</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($queryModel as $qb)
      <tr>
        <td>{{ $qb->generic_name }}</td>
        <td>{{ $qb->form }}</td>
        <td>{{ $qb->restriction_formula }}</td>
        <td>{{ $qb->description }}</td>
        <td><a href="{{ route('obat.edit',$qb->id)}}" class="btn btn-xs btn-info">Edit</a>
          <form method="POST" action="{{route('obat.destroy',$qb->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" value="delete" class="btn btn-danger btn-xs"
            onclick="if(!confirm('are you sure to delete this record?')) return false;"/>
          </form></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-bar">
    <div class="page-toolbar">
      <a href="{{route('obat.create')}}" class='btn btn-info' type="button">+ New Medicine</a>
    </div>
  </div>
</div>

@endsection