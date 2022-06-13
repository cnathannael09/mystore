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
  <h2>List Transaction</h2>
  <p>Berikut adalah daftar Transaksi:</p>            
  <table class="table">
            <thead>
                <th>ID</th>
                <th>Pembeli</th>
                <th>Kasir</th>
                <th>Tanggal Transaksi</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($queryModel as $qm)
                <tr>
                    <td>{{ $qm->id }}</td>
                    <td>{{ $qm->buyer->name }}</td>
                    <td>{{ $qm->user->name }}</td>
                    <td>{{ $qm->created_at }}</td>

                    <td><a class="btn btn-default" data-toggle="modal" href="#basic"
                     onclick="getDetailData({{$qm->id}})">Lihat Rincian Pembelian</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>    
</body>

<script>
    function getDetailData(id){
        $.ajax({
            type:'POST',
            url:'{{route("transaction.showAjax")}}',
            data: '_token= <?php echo csrf_token() ?> &id='+id,
            success:function(data){
                $("#msg").html(data.msg);
            }
        });
    }
</script>
</html>
