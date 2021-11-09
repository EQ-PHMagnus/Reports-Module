<div class="modal fade" id="filterModal" aria-labelledby="filterModal" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Search and Filter Agent Commissions</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Search</label>
                            <input type="text" class="form-control filters" name="search" placeholder="Name or Level" value="{{request('search')}}" autocomplete="off">
                        </div>
                        <div class="form-group col-12">
                            <label>Amount</label>
                            <input type="number" class="form-control filters" name="amount" placeholder="0.00" value="{{request('amount')}}" autocomplete="off">
                        </div>
                        <div class="form-group col-12">
                            <label>Date Commission From</label>
                            <input type="date" class="form-control filters" name="from" value="{{request()->input('from',\Carbon\Carbon::now()->subYear()->format('Y-m-d'))}}" autocomplete="off">
                        </div>
                        <div class="form-group col-12">
                            <label>Date Commission To</label>
                            <input type="date" class="form-control filters" name="to" value="{{request()->input('to',date('Y-m-d'))}}" autocomplete="off">
                        </div>
                      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block btn-filter-search">Submit</button>
                        <a @if(request()->route()->named('agent-commissions.super_agent'))
                                href="{{route('agent-commissions.super_agent')}}" 
                            @else
                                href="{{route('agent-commissions.agent')}}"
                            @endif
                        class="btn btn-secondary btn-block">Reset</a>
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>