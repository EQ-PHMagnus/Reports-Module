

<div class="row mt-5">
    <div class="col-md-12">
        <div class="form-group">
            <input @if(request()->input('view',null) != null) id="true" @else id="false" @endif hidden type="text" class="filters" name="chart" value="@if(request()->input('view',null) != null) true @else false @endif">
            <select class="float-left form-control col-md-2 mr-5 filters" name="group">
                @if(request()->input('view',null) == null)
                    <option selected value="daily">DAILY</option>
                @endif
                <option  @if(request()->input('view',null) != null) selected @endif value="monthly">MONTHLY</option>
                <option value="yearly">YEARLY</option>
            </select>
            <input value="{{date('2014-m-d')}}" class="float-left form-control col-md-2 mr-5 filters" type="date" name="from" value="{{request()->from}}">
            <input value="{{date('Y-m-d')}}" class="float-left form-control col-md-2 mr-5 filters" type="date" name="to" value="{{request()->to}}">
            <button type="button" class="btn btn-round btn-outline btn-primary @if(request()->input('view',null) != null) btn-filter-chart @else btn-filter-table @endif">Filter</button>
        </div>
    </div>
</div>