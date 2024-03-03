@extends("front.layout")


@section("main")

    <section class="content" style="min-height: 600px">

        <div class="callout callout-info">
          <center> <h1>{{config("admin.researchtitle")}}</h1></center>
        </div>
        <div class="col-md-4" ></div>
        <div class="col-md-4" >
        <a href="{{admin_url("processmodel/phaseone")}}"  >
            <button type="button" class="btn btn-block btn-success btn-lg">{{__("front.start")}}</button>
        </a>
        </div>
    </section>

@endsection
