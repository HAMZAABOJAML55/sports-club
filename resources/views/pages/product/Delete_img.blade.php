<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_img{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('image.destroy',$i->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$i->id}}">
                    <input type="hidden" name="product_name" value="{{$i->imageable->name}}">
                    <input type="hidden" name="product_id" value="{{$i->imageable->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">title</h5>
                    <input type="text" name="file_name" readonly value="{{$i->file_name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">choose</button>
                        <button  class="btn btn-danger">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
