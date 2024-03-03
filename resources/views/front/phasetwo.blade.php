@extends("front.layout")
@section("main")
    <section class="content" style="min-height: 600px">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{__("front.subheaderphasetwo")}}</h3>
            </div>
            <div class="box-body">
             <form action="{{ admin_url('processmodel/phasetwo') }}" method="post" >
                 {{ csrf_field() }}
                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredconsenses")}}</h3>
                     </div>
                     <div class="box-body">
                              <div class="form-group">
                             <?php $name="consensusmechanisms" ;foreach(\App\Models\ConsensusMechanisms::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('consensusmechanisms',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>

                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredlanguage")}}</h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="programminglanguages" ;foreach(\App\Models\Programminglanguages::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                               <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('programminglanguages',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>

                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredscalibilty")}}</h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="scalabilitytypes" ;foreach(\App\Models\Scalabilitytypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('scalabilitytypes',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>

                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredprivacy")}}</h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="privacytypes" ;foreach(\App\Models\PrivacyTypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('privacytypes',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>


                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredinteropability")}}</h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="interoperabilitytypes" ;foreach(\App\Models\Interoperabilitytypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('interoperabilitytypes',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>


                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredreslince")}}</h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="resiliencetypes" ;foreach(\App\Models\Resiliencetypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('resiliencetypes',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>


                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredlayers")}}</h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="layersupports" ;foreach(\App\Models\Layersuppors::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('layersupports',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>
                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title">{{__("front.requiredcontract")}}</h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="contractsupports" ;foreach(\App\Models\Contractsupports::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="{{$name.$item->id}}" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="{{$name.$item->id}}" onmouseover="details('contractsupports',{{$item->id}})" data-toggle="tooltip" data-placement="top" >
                                   {{$item->name}}
                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>
                 <div class="form-group">
                     <div class="row">
                     <div class="col-md-3">
                         <span>Transaction speed</span>
                     <select class="form-control">
                         <option>High Transaction speed</option>
                         <option>Medium Transaction speed</option>
                         <option>Low Transaction speed</option>
                     </select>
                     </div>
                     <div class="col-md-3">
                         <span>Community</span>
                         <select class="form-control">
                             <option>Big Community</option>
                             <option>Medium Community</option>
                             <option>Small Community</option>
                         </select>
                     </div>
                     <div class="col-md-3">
                         <span>popularity in the market</span>
                         <select class="form-control">
                             <option>popular</option>
                             <option>average</option>
                             <option> neglected</option>
                             <option> controversial</option>
                             <option> rejected</option>

                         </select>
                     </div>
                     <div class="col-md-3">
                         <span>Maturity of the platform</span>
                         <select class="form-control">
                             <option>High </option>
                             <option>Medium</option>
                             <option>Low</option>
                         </select>
                     </div>
                     </div>


                 </div>
                 <?php if(isset($ispost)){?>
                 <div class="form-group">
                     @include("front.includes.phasetwoplatform")
                 </div>
                 <?php }?>
                 <div class="form-group">
                <?php if(!isset($ispost)){?>
                    <button  class="btn btn-info btn-lg" type="post">Submit</button>
                     <?php }else{;?>


               <a href="{{admin_url("processmodel/phasethree")}}" class="btn btn-warning btn-lg" >  Go to Phase Three</a>
                    <?php }?>
                 </div>

             </form>
            </div>
        </div>
    </section>

@endsection

@section("scripts")
    <script>


        function  details(table,id) {
            var $this = $(this);
            $.ajax({
                url: "{{admin_url("front/ajax")}}",
                type: "get", //send it through get method
                data: {
                    table: table,
                    id: id,
                },
                success: function(response) {

                    $("#"+table+id).attr('title', response);
                },
                error: function(xhr) {
                  console.log("error happend");
                }
            });
        }

    </script>

@endsection
