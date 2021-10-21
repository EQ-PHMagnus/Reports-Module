<div class="row clearfix">
    <div class="col">
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Please check the following fields</strong><br/>
                    @foreach ($errors->all() as $error)
                       {{ $error }} <br />
                    @endforeach
            </div>
        @endif

        @if(session()->has('msg'))
            <div class="alert alert-{{session()->get('msgClass')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>{!! session()->get('msg') !!}</strong>
            </div>
        @endif
    </div>
</div>
