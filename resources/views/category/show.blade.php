@extends('layout.adminlte')
  @section('content')
<div class="container">
  <h2>Show Category</h2>
  <p>Berikut adalah kategori:</p>  
  @if ($message)          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $message->name }}</td>
        <td>{{ $message->description }}</td>
      </tr>
    </tbody>
  </table>
  @else
    <h2>Tidak ada data</h2>
  @endif
</div>

@endsection
