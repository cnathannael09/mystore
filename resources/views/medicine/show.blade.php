@extends('layout.adminlte')
  @section('content')  

<div class="container">
  <h2>Show Medicine</h2>
  <p>Berikut adalah daftar Produk:</p>  
  @if ($message)          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Form</th>
        <th>Restriction Formula</th>
        <th>Description</th>
        <th>Category name</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $message->generic_name }}</td>
        <td>{{ $message->form }}</td>
        <td>{{ $message->restriction_formula }}</td>
        <td>{{ $message->description }}</td>
        <td>{{ $message->category->name }}</td>
      </tr>
    </tbody>
  </table>
  @else
    <h2>Tidak ada data</h2>
  @endif
</div>

@endsection