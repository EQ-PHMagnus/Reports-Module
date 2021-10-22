

<div class="row mt-5">
    <div class="col-md-12">
        <div class="form-group">
          
            <select class="float-left form-control col-md-2 mr-5 filters" name="group">
                <option  value="daily">DAILY</option>
                <option selected value="monthly">MONTHLY</option>
                <option value="yearly">YEARLY</option>
            </select>
            <input value="{{date('2014-m-d')}}" class="float-left form-control col-md-2 mr-5 filters" type="date" name="from" value="{{request()->from}}">
            <input value="{{date('Y-m-d')}}" class="float-left form-control col-md-2 mr-5 filters" type="date" name="to" value="{{request()->to}}">
            <button type="button" class="btn btn-round btn-outline btn-primary btn-filter">Filter</button>
            <button type="button" class="btn btn-round btn-outline btn-primary btn-filter-export"><i class="wb-download"></i> Export</button>
        </div>
    </div>
</div>