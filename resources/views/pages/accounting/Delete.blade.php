<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete{{$accounting->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('accounting_trans.Deleted_Student')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounting.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" value="{{$accounting->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('accounting_trans.Deleted_title')}}</h5>
                    <input type="text" readonly value="{{$accounting->number}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('accounting_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('player_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
