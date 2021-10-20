@extends('commons.layout')
@section('title')
Players
@endsection

@section('page-title')
Players Management
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">Players Management</li>
@endsection

@section('page-header-actions')
    <a href="{{route('players.create')}}" type="button" class="btn btn-icon btn-primary btn-outline"><i class="icon wb-plus" aria-hidden="true"></i> Add Player</a>   
@endsection

@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Players List</h3>
                @include('filters.general.filter-table')
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Agent Code</th>
                                <th class="text-center">Agent Level</th>
                                <th>Player Account</th>
                                <th>Player Name</th>
                                <th>Birthday</th>
                                <th class="text-center">Current Credits</th>
                                <th>Phone Number</th>
                                <th>Joined Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($players as $key => $player)
                            <tr>
                                <td>{{$player->agent_code ?? ''}}</td>
                                <td class="text-center">{{$player->level ?? ''}}</td>
                                <td>{{$player->username ?? ''}}</td>
                                <td>{{$player->name ?? ''}}</td>
                                <td>{{$player->dob ?? ''}}</td>
                                <td class="text-center">{{$player->points ? moneyFormat($player->points): ''}}</td>
                                <td>{{$player->mobile_number ?? ''}}</td>
                                <td>{{$player->created_at->toDateTimeString() ?? ''}}</td>
                                <td>
                                    @php
                                        $giid = $player->identification;
                                        if(strpos($giid, 'picsum') === false){
                                            $giid = asset('storage/'. $player->identification);
                                        }

                                        $recent_photo = $player->recent_photo;
                                        if(strpos($recent_photo, 'picsum') === false){
                                            $recent_photo = asset('storage/'. $player->recent_photo);
                                        }
                                    @endphp
                                    <button class="btn btn-icon btn-primary btn-outline view-gallery" title="View GIID" data-giid="{{$giid}}" data-rp="{{$recent_photo}}">
                                        <i class="icon wb-gallery" aria-hidden="true"></i>
                                    </button>
                                    <a href="{{route('players.edit',$player->id)}}" class="btn btn-icon btn-default btn-outline" data-toggle="tooltip" data-title="Edit this player"><i class="icon wb-pencil" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-icon btn-danger btn-outline btn-destroy-model" data-toggle="tooltip" data-title="Delete this player" data-url="{{route('players.destroy',$player->id)}}"><i class="icon wb-trash" aria-hidden="true"></i></button>
                                    {{-- <button type="button" class="btn btn-icon btn-primary btn-outline" data-toggle="tooltip" data-title="Transact" ><i class="icon fa-money" aria-hidden="true"></i></button> --}}
                                </td>
                            </tr>
                            @empty
                                <tr><td class="text-center" colspan="5">No records found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row "> 
                    <div class="col-12 d-flex justify-content-center">
                        <p>Showing {{ $players->firstItem() }} to {{ $players->lastItem() }}
                        of total {{$players->total()}} entries</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        {{ $players->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterModal" aria-labelledby="filterModal" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <form  method="GET" autocomplete="off" id="filterForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Search and Filter Agents</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Search</label>
                                <input type="text" class="form-control" name="search" placeholder="Agent Code, Username or Full name" value="{{request('search')}}" autocomplete="off">
                            </div>
                            <div class="form-group col-12">
                                <label>From</label>
                                <input type="date" class="form-control" name="from" value="{{request()->input('from',\Carbon\Carbon::now()->subDays('30')->format('Y-m-d'))}}" autocomplete="off">
                            </div>
                            <div class="form-group col-12">
                                <label>To</label>
                                <input type="date" class="form-control" name="to" value="{{request()->input('to',date('Y-m-d'))}}" autocomplete="off">
                            </div>
                            <input type="hidden" name="export" value="false" id="export">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                        <a href="{{route('players.index')}}" class="btn btn-secondary btn-block">Reset</a>
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="galleryModal" aria-labelledby="galleryModal" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sm">
            <form  method="GET" autocomplete="off" id="filterForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Gallery</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-12 gallery-giid">
                            <label>GIID</label>
                            <a class="inline-block mt-10"  data-plugin="magnificPopup" data-main-class="mfp-img-mobile">
                              <img class="img-fluid"  alt="..." width="220">
                            </a>
                        </div>
                        <div class="form-group col-12 gallery-rp">
                            <label>Recent Photo</label>
                            <a class="inline-block mt-10" data-plugin="magnificPopup" data-main-class="mfp-img-mobile">
                              <img class="img-fluid" width="150" height="150"  alt="...">
                            </a>
                        </div>   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('global/vendor/magnific-popup/magnific-popup.css')}}">
@endpush
@push('scripts')
<script src="{{asset('global/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('global/js/Plugin/magnific-popup.js')}}"></script>
<script type="text/javascript">
    $(".view-gallery").click(function (e) {
        e.preventDefault();
        const giid = $(this).data('giid');
        const rp = $(this).data('rp');
        const modal = $("#galleryModal");

        modal.on('show.bs.modal',function(){
            //GIID
            const giidThumb = modal.find('.gallery-giid');

            giidThumb.find('a').prop('href',giid);
            giidThumb.find('img').prop('src',giid);

            //GIID
            const rpThumb = modal.find('.gallery-rp');

            rpThumb.find('a').prop('href',rp);
            rpThumb.find('img').prop('src',rp);
        });
        modal.modal('show');
    });
</script>
@endpush

