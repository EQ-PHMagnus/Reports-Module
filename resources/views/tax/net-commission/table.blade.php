<div class="card card-shadow" >
    <div class="card-header text-center bg-primary">
        Net Commission Tax Reports
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table  class="table-fit no-view "
                data-mobile-responsive="true"
                data-toggle="table"
                data-ajax="dataRequest"
                data-side-pagination="server"
                data-sortable="true"
                data-detail-formatter="detailFormatter"
                data-pagination="true"
                data-sort-order="desc"
                data-chart="false"
                data-count="false"
                data-search="true">
                <thead>
                    <tr>
                        <th></th>
                        <th  colspan="3" class="text-center" data-field="">Basis from GR</th>
                        <th  colspan="3" class="text-center" data-field="">Basis from TB</th>
                    </tr>
                    <tr>
                        <th  class="text-left" data-field="date">Date </th>
                        <th  class="text-left" data-field="gr_basis_gc">GC</th>
                        <th  class="text-left" data-field="gr_basis_with_holding">Less: 10% Withholding</th>
                        <th  class="text-left" data-field="gr_basis_nc">NC</th>
                        <th  class="text-left" data-field="tb_basis_gc">GC</th>
                        <th  class="text-left" data-field="tb_basis_with_holding">Less: 10% Withholding</th>
                        <th  class="text-left" data-field="tb_basis_nc">NC</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>