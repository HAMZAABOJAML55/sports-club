<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_Student{{$player->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('Students_trans.Deleted_Student')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('player.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" value="{{$player->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('player_trans.Deleted_tilte')}}</h5>
                    <input type="text" readonly value="{{$player->name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('player_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('player_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
