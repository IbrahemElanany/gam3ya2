<div id="inputFormRow">
    <div class="row">
        <div class="col-md-4"><label class="form-label">{{trans('lang.product')}}</label>
            <select name="details[{{$count_value}}][subcategory_id]"
                    class="form-control form-control-lg "
                    required>
                @foreach($data as $subcategory)
                    <option value="{{$subcategory->id}}">
                        @if(Session::get('lang')=='ar'){{ $subcategory->name_ar }}@else{{ $subcategory->name_en }}@endif
                    </option>
                @endforeach</select></div>
        <div class="col-md-2">
            <label class="required fw-bold fs-6 mb-2">{{__('lang.number')}}</label>
            <input type="number" name="details[{{$count_value}}][number]" class="form-control  mb-3 mb-lg-0" placeholder=""
                   value="{{old('number')}}" required/>
        </div>
        <div class="col-md-2">
            <label class="required fw-bold fs-6 mb-2">{{__('lang.delete')}}</label>
            <br>
            <button id="removeRow" type="button" class="btn btn-danger mb-3 mb-lg-0">{{trans('lang.delete')}}</button>
        </div>
    </div>
</div>
