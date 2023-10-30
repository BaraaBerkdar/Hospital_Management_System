<!-- Deleted insurance -->

<div class="modal fade" id="Deleted{{ $Patient->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف بيانات مريض</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Patients.destroy') }}" method="post">
              
                    @csrf
                    <input type="hidden" name="id" value="{{ $Patient->id }}">
                    <div class="row">
                        <div class="col">
                            <p > هل انت متاكد من حذف بيانات المريض ؟ </p>
                            <input type="text" class="form-control" readonly value="{{ $Patient->name }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('insurance.close')}}</button>
                        <button type="submit" class="btn btn-danger">{{trans('insurance.Title_deleted')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
