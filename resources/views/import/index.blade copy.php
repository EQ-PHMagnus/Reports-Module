@extends('commons.layout')
@section('title')
Import
@endsection
@section('page-title')
Import Data
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('app/css/import/upload-file.css')}}">
@endpush
@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    @forelse(config('defaults.imports') as $key => $import)
                        <div class="col-lg-3 col-lg-3">
                            <div class="upload">
                                <div class="upload-files">
                                    <header>
                                        <p>
                                            <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                            <span class="up">&nbsp;</up>
                                            <span class="load"> Upload {{ucwords($import)}}</span>
                                        </p>
                                    </header>
                                    <div class="body" id="drop">
                                        <i class="fa fa-file-text-o pointer-none" aria-hidden="true"></i>
                                        <p class="pointer-none"><b>Drag and drop</b> files here <br /> or <a href="#" class="{{$import}}">browse</a> to begin the upload</p>
                                        <input type="file" class="{{$import}}"  />
                                    </div>
                                    <footer>
                                        <div class="list-files">
                                            <!--   template   -->
                                        </div>
                                        <button class="importar">UPDATE FILES</button>
                                    </footer>
                                </div>
                            </div>  
                        </div>  
                    @empty
                    <div class="col-lg-12 col-lg-12">
                        <h4 class="text-center">Sorry. Data not available.</h4>
                    </div>
                    @endforelse      
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('app/js/import/upload-file.js')}}"></script>
@endpush

