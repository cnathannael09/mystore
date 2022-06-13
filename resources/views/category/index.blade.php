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
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Logo</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $li)
      <tr id='tr_{{$li->id}}'>
        <td>{{$li->id}}</td>
        <td class='editable' id="td_name_{{$li->id}}">{{ $li->name }}</td>
        <td class='editable' id="td_description_{{$li->id}}">{{ $li->description }}</td>
        <td><img height='50px' src="{{asset('images/'.$li->logo)}}">
        <br>
        <a href="#modalChange_{{$li->id}}" data-toggle='modal' class="btn btn-xs btn-default"> Change </a>
        </td>

<div class="modal fade" id="modalChange_{{$li->id}}" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
        <form method="POST" action="{{route('kategori.changeLogo')}}" enctype='multipart/form-data'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Change Logo</h4>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo"/>
                        <input type="hidden" id="id" name="id" value="{{$li->id}}"/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Submit</button>
                <a class="btn btn-default" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</div>

        <td>
          <a href="{{ route('kategori.edit',$li->id)}}" class="btn btn-xs btn-info">Edit</a>
          <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-info' onclick="getEditForm({{$li->id}})">
          + Edit A
          </a>
          <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-info' onclick="getEditForm2({{$li->id}})">
          + Edit B
          </a>
          <form method="POST" action="{{route('kategori.destroy',$li->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" value="delete" class="btn btn-danger btn-xs"
            onclick="if(!confirm('are you sure to delete this record?')) return false;"/>
          </form>
          <a class="btn btn-danger btn-xs" onclick="if(confirm('are you sure to delete this record?')) deleteDataRemoveTR({{$li->id}})">Delete 2</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-bar">
    <div class="page-toolbar">
      <a href="{{route('kategori.create')}}" class='btn btn-info' type="button">+ New Category</a>
    </div>
    <div class="page-toolbar">
      <a href="#modalCreate" data-toggle='modal' class='btn btn-info'>
        + New Category(modal)
      </a>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Category</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('kategori.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name">
                        <small class="form-text text-muted">Please Enter Your Category Name</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('kategori.index')}}" type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id='modalContent'>
    </div>
  </div>
</div>

@endsection

@section('javascript')
<script>
  function getEditForm(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("kategori.getEditForm")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'id':id
            },
      success: function(data){
        $('#modalContent').html(data.msg)
      }
    });
  }

  function getEditForm2(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("kategori.getEditForm2")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'id':id
            },
      success: function(data){
        $('#modalContent').html(data.msg)
      }
    });
  }

  function deleteDataRemoveTR(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("kategori.deleteData")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'id':id
            },
      success: function(data){
        if(data.status=='ok'){
          alert(data.msg)
          $('#tr_'+id).remove();
        }
        else{
          alert(data.msg)
        }
      }
    });
  }

</script>
@endsection

@section('initialscript')
<script src="{{ asset('assets/plugins/jquery.editable.min.js')}}" type="text/javascript"></script>
<script>
  $('.editable').editable({
    closeOnEnter :true,
    callback:function(data){
      if(data.content){
        var s_id=data.$el[0].id
        var fname=s_id.split('_')[1]
        var id=s_id.split('_')[2]

        $.ajax({
          type:'POST',
          url:'{{route("kategori.saveDataField")}}',
          data:{'_token':'<?php echo csrf_token() ?>',
          'id':id,
          'fname':fname,
          'value':data.content
          },
          success: function(data){
            alert(data.msg)
          }
        });
      }
    }
  });
</script>
@endsection