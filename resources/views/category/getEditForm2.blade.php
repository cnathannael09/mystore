<form role="form" method="POST" action="{{route('kategori.update',$data->id)}}">
    <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
    </div>
    <div class="modal-body">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="eName" placeholder="Enter Category Name" name="name" value="{{$data->name}}">
            <small class="form-text text-muted">Please Enter Your Category Name</small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="eDescription" rows="3" name="description">{{$data->description}}</textarea>
        </div>
    </div>
</form>
<div class="modal-footer">
    <button type="submit" class="btn btn-info" data-dismiss='modal' onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
    <a href="{{route('kategori.index')}}" type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</a>
</div>

<script>
    function saveDataUpdateTD(id)
    {
        var eName=$('#eName').val();
        var eDescription=$('#eDescription').val();
        $.ajax({
            type:'POST',
            url:'{{route("kategori.saveData")}}',
            data:{'_token':'<?php echo csrf_token() ?>',
                'id':id,
                'name':eName,
                'description':eDescription
            },
            success: function(data){
                if(data.status=='ok')
                {
                    alert(data.msg)
                    $('#td_name_'+id).html(eName);
                    $('#td_description_'+id).html(eDescription);
                }
                $('#modalContent').html(data.msg)
            }
        });
    }
</script>