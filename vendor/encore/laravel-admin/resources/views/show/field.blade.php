   <?php if($istable=="true"){?>
  <label class=" control-label ">{{ $label }}</label>
  <label class="control-label" style="margin:10px">@if($escape)
                    {{ $content }}&nbsp;
                @else
                    {!! $content !!}&nbsp;
                @endif</label>
   <?php } else{?>

<div class="form-group ">
      @if($label!=="Image")
        <label class="col-md-3 control-label">{{ $label }}</label>
    @endif

    <div class="col-md-6">

        @if($wrapped)
        <div class="box box-solid  no-margin box-show">
            <!-- /.box-header -->
            <div class="box-body">
                @if($escape)
                    {{ $content }}&nbsp;
                @else
                    {!! $content !!}&nbsp;
                @endif
            </div><!-- /.box-body -->
        </div>
        @else
            @if($escape)
                {{ $content }}
            @else
                {!! $content !!}
            @endif
        @endif
    </div>
</div>
   <?php }?>