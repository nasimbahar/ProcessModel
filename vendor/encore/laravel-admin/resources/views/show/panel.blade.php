<div class="box box-{{ $style }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>

        <div class="box-tools">
            {!! $tools !!}
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">

            <div class="fields-group">
               <?php $index=0; if($istwocolumns=='true'){ ?>

                <table style="width: 100%;">
                <?php foreach($fields as $field):?>


                   <?php if($index%2==0){?>
                    <tr >

                        <td style="width: 50%">

                    <?php echo $field->render();?>

                        <td>
                   <?php }else{?>
                        <td style="width: 50%">

                    <?php echo $field->render();?>

                        <td>
             <?php if($index%2==0){?>
                       </tr>


             <?php }}?>


               <?php $index++; endforeach;
               echo "</table>";} else{?>
                @foreach($fields as $field)
                    {!! html_entity_decode($field->render()) !!}
                @endforeach
               <?php }?>
            </div>

        </div>
        <!-- /.box-body -->
    </div>

</div>
