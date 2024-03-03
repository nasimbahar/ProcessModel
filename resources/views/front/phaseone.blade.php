@extends("front.layout")
@section("main")

    <section class="content" style="min-height: 600px">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{__("front.subheaderphaseone")}}</h3>
            </div>
            <div class="box-body">

                <ul class="timeline">

                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-green">
                           {{__("front.start")}}
                        </span>
                    </li>
                    <li id="q1">
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-down"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header">{{__("front.q1")}}</h3>
                            <div class="timeline-body" id="q1body">
                                <button class="btn btn-info" id="q1yes">{{__("front.yes")}}</button>
                                <button class="btn btn-danger" id="q1no">{{__("front.no")}}</button>
                            </div>

                        </div>
                    </li>


                    <li style="display: none" id="q2" >
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-down"></i>
                        <div class="timeline-item">


                            <h3 class="timeline-header">{{__("front.q2")}}</h3>

                            <div class="timeline-body" id="q2body">

                                <button class="btn btn-info" id="q2yes">{{__("front.yes")}}</button>
                                <button class="btn btn-danger" id="q2no">{{__("front.no")}}</button>
                            </div>


                        </div>
                    </li>



                    <li style="display: none" id="q3" >
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-down"></i>
                        <div class="timeline-item">


                            <h3 class="timeline-header">{{__("front.q3")}}</h3>

                            <div class="timeline-body" id="q3body">

                                <button class="btn btn-info" id="q3yes">{{__("front.yes")}}</button>
                                <button class="btn btn-danger" id="q3no">{{__("front.no")}}</button>
                            </div>


                        </div>
                    </li>


                    <li style="display: none" id="q4" >
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-down"></i>
                        <div class="timeline-item">


                            <h3 class="timeline-header">{{__("front.q4")}}</h3>

                            <div class="timeline-body" id="q4body">

                                <button class="btn btn-info" id="q4yes">{{__("front.yes")}}</button>
                                <button class="btn btn-danger" id="q4no">{{__("front.no")}}</button>
                            </div>

                            <div class="timeline-footer">

                            </div>
                        </div>
                    </li>


                    <li style="display: none" id="q5" >
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-down"></i>
                        <div class="timeline-item">


                            <h3 class="timeline-header">{{__("front.q5")}}</h3>

                            <div class="timeline-body" id="q5body">

                                <button class="btn btn-info" id="q5yes">{{__("front.yes")}}</button>
                                <button class="btn btn-danger" id="q5no">{{__("front.no")}}</button>
                            </div>


                        </div>
                    </li>


                    <li style="display: none" id="q6" >
                        <!-- timeline icon -->
                        <i class="fa fa-arrow-circle-down"></i>
                        <div class="timeline-item">


                            <h3 class="timeline-header">{{__("front.q6")}}</h3>

                            <div class="timeline-body" id="q6body">

                                <button class="btn btn-info" id="q6yes">{{__("front.yes")}}</button>
                                <button class="btn btn-danger" id="q6no">{{__("front.no")}}</button>
                            </div>


                        </div>
                    </li>


                    <li class="time-label">
                            <span class="bg-red">
                            {{__("front.end")}}
                            </span>
                    </li>


                </ul>
            </div>

        </div>

    </section>


@endsection
@section("scripts")
    <script type="text/javascript">
        $(function () {
            var nohtml=' <a class="btn btn-danger btn-xs noneed" >{{__("front.noneed")}}</a>';
            var nohtmlwithoutext=' <a class="btn btn-danger btn-xs noneed" ></a>';
            var publicpermissionlesslabel='<div class="alert alert-success alert-dismissible">\n' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                '<h4><i class="icon fa fa-check"></i> Alert!</h4>\n' +
                '{{__("front.needpublicblockchian")}}.\n' +
                '</div>';
            var publicpermissionedlabel='<div class="alert alert-success alert-dismissible">\n' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                '<h4><i class="icon fa fa-check"></i> Alert!</h4>\n' +
                '{{__("front.needpublicpermissionblockchian")}}.\n' +
                '</div>';
                var buttonphaswtwo=' <a class="btn btn-warning btn-lg noneed" href={{admin_url("processmodel/phasetwo")}} >{{__("front.gotosecondphase")}}</a>';
            var secondphasepublicpermissionless='<div class="publicpermissionless">'+publicpermissionlesslabel+buttonphaswtwo+' </div>';
            var secondphasepublicpermissioned='<div class="publicpermissioned">'+publicpermissionedlabel+ buttonphaswtwo+'</div>';
            var privatepermissionlesslabel='<div class="alert alert-success alert-dismissible">\n' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                '<h4><i class="icon fa fa-check"></i> Alert!</h4>\n' +
                '{{__("front.needprivate")}}.\n' +
                '</div>';
            var privatepermissionedlabel='<div class="alert alert-success alert-dismissible">\n' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                '<h4><i class="icon fa fa-check"></i> Alert!</h4>\n' +
                '{{__("front.needprivatepermission")}}.\n' +
                '</div>';
            var secondphaseprivatepermissionless='<div class="privatepermissionless">'+privatepermissionlesslabel+ buttonphaswtwo+'</div>';
            var secondphaseprivatepermissioned='<div class="privatepermissioned">'+privatepermissionedlabel+ buttonphaswtwo+'</div>';


            /// 1
            $("#q1no").click(function(){
                if (!$('.noneed').length) {
                    $("#q1body").after(nohtml);
                }
            });
            $("#q1yes").click(function(){
                $("#q1body").after(nohtmlwithoutext);
                $("#q1body").css("display","none");

                $("#q1 .noneed").removeClass("btn-danger").addClass("btn-success").html('<i class="fa fa-check-circle"></i>');
                $("#q2").css("display","block");
            });
            /// 2
            $("#q2no").click(function(){
                if (!$('.noneed').hasClass("btn-danger")) {
                    $("#q2body").after(nohtml);
                }
            });

            $("#q2yes").click(function(){
                $("#q2body").after(nohtmlwithoutext);
                $("#q2body").css("display","none");
                $("#q2 .noneed").removeClass("btn-danger").addClass("btn-success").html('<i class="fa fa-check-circle"></i>');
                $("#q3").css("display","block");
            });
            /// q3
            $("#q3no").click(function(){


                $("#q3body").css("display","none");
                $("#q3 .noneed").removeClass("btn-danger").addClass("btn-success").html('<i class="fa fa-check-circle"></i>');
                $("#q5").css("display","block");
            });
            $("#q3yes").click(function(){
                $("#q3body").after(nohtmlwithoutext);
                $("#publicpermissionless").css("display","none");
                $("#q3body").css("display","none");
                $("#q3 .noneed").removeClass("btn-danger").addClass("btn-success").html('<i class="fa fa-check-circle"></i>');
                $("#q4").css("display","block");
            });
            //q4
            $("#q4no").click(function(){

                    $("#q4body").after(nohtmlwithoutext);

                $("#q4body").css("display","none");
                $("#q4 .noneed").removeClass("btn-danger").addClass("btn-success").html('<i class="fa fa-check-circle"></i>');

                $("#q6").css("display","block");
            });
            $("#q4yes").click(function(){
                if (!$('.noneed').hasClass("btn-danger")) {
                    $("#q4body").after(nohtml);
                }
            });

            //q5

            $("#q5yes").click(function(){
                if ($('.publicpermissioned').length) {
                    $(".publicpermissioned").css("display","none");
                }
                $(".publicpermissionless").css("display","block");
                if (!$('.publicpermissionless').length) {
                    $("#q5body").after(secondphasepublicpermissionless);
                }
            });
            $("#q5no").click(function(){

                if ($('.publicpermissionless').length) {
                    $(".publicpermissionless").css("display", "none");
                }
                $(".publicpermissioned").css("display","block");
                if (!$('.publicpermissioned').length) {
                    $("#q5body").after(secondphasepublicpermissioned);
                }
            });


            //q6
            $("#q6yes").click(function(){
                if ($('.privatepermissionless').length) {
                    $(".privatepermissionless").css("display","none");
                }
                $(".privatepermissioned").css("display","block");
                if (!$('.privatepermissioned').length) {
                    $("#q6body").after(secondphaseprivatepermissioned);
                }
            });
            $("#q6no").click(function(){

                if ($('.privatepermissioned').length) {
                    $(".privatepermissioned").css("display", "none");
                }
                $(".privatepermissionless").css("display","block");
                if (!$('.privatepermissionless').length) {
                    $("#q6body").after(secondphaseprivatepermissionless);
                }
            });


        })
    </script>


@endsection
