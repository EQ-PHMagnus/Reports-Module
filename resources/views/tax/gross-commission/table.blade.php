<div class="card card-shadow" >
    <div class="card-header text-center bg-primary">
        Gross Commission Tax Reports
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
                        <th  class="text-left" data-field="date">Date </th>
                        <th  class="text-left" data-field="basis-gr">Basis is from GR (GR * .02)</th>
                        <th  class="text-left" data-field="basis-bets">Basis is from Total Bets (TB * .02)</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>