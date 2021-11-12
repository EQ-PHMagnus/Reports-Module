@extends('commons.layout')
@section('title')
{{$data['title'] ?? null}}
@endsection

@section('page-title')
{{$data['title'] ?? null}}
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">{{$data['content_title'] ?? null}}</li>
@endsection



@section('page-content')
<div class="row">
    <div class="col">
        @include('filters.for-list')
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{$data['content_title'] ?? null}}</h3>
            </div>
            <div class="panel-body">
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
                        data-search="true">
                        <thead>
                            <tr>
                                <th class="text-left" data-field="date" >Date</th>
                                <th class="text-left" data-field="count"  class="text-center">Count</th>
                                <th class="text-left" data-field="sum"  class="text-center">Amount</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
