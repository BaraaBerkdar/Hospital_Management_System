<!-- Modal -->
<div class="modal fade" id="delete{{ $appointment->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    حذف موعد </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('app.destroy') }}" method="post">
                @csrf
                @if ($appointment->type=="غير مؤكد")
                    
                <div class="modal-body">
                    <h5>هل انت متأكد من الغاء حجز الموعد مع الدكتور <br> Dr.{{$appointment->Doctor->name}}</h5>
                   
                    <input type="hidden" name="id" value="{{ $appointment->id }}">
                </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
