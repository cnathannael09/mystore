<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>List Products</h2>
  <p>Berikut adalah daftar Produk:</p>            
  <table class="table table-bordered">
      <tbody>
          <div class="row">
                @php
                $i = 2
                @endphp
                @foreach($queryBuilder as $qb)
                <div class="col col-lg-2"><img src="{{ asset('img/'.$qb->image) }}" width="200" height="200"/> </div>
                @if ($i++ % 3 == 1)
                </div><div class="row">
                @endif
                @endforeach
            </div>
        </tbody>
    </table>
</div>    

<div class="container">
  <h2>List Products</h2>
  <p>Berikut adalah daftar Produk:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Form</th>
        <th>Restriction Formula</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
        @foreach($queryBuilder as $qb)
      <tr>
        <td>{{ $qb->generic_name }}</td>
        <td>{{ $qb->form }}</td>
        <td>{{ $qb->restriction_formula }}</td>
        <td>{{ $qb->description }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
