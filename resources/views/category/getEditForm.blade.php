<form role="form" method="POST" action="{{route('kategori.update',$data->id)}}">
    <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
    </div>
    <div class="modal-body">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name" value="{{$data->name}}">
            <small class="form-text text-muted">Please Enter Your Category Name</small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description">{{$data->description}}</textarea>
        </div>
    </div>
</form>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('kategori.index')}}" type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</a>
</div>