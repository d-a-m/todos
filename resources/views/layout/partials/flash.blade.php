<div class="container">
    <div class="row">
        <div class="col">

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger">
                {!! Session::get('error') !!}
            </div>
            @endif

            @if(isset($errors) && count($errors->all()) > 0)
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                    <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <?php
                Session::forget('success');
                Session::forget('error');
                unset($errors);
            ?>

        </div>
    </div>
</div>