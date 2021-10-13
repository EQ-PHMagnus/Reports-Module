<div class="modal fade" id="filter" aria-labelledby="filterUsers" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Filter</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control filters" name="search" placeholder="Search" value="{{request('search')}}" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block btn-filter-search">Search</button>
                    <button type="button" class="btn btn-primary btn-block btn-filter-refresh">Refresh</button>
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>