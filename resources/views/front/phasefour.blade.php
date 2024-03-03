@extends("front.layout")
@section("main")
    <section class="content" style="min-height: 600px">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Cost Estimation</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <i class="fa fa-text-width"></i>
                                <h3 class="box-title">Cost Estimation  </h3>
                            </div>

                            <div class="box-body col-lg-6" >
                               <form action="{{ admin_url('processmodel/phasefour') }}" class="form" method="post">
                                   {{ csrf_field() }}
                                   <div class="form-group">
                                    <label>Number of Smart Contract</label>
                                       <input type="number" class="form-control" name="numContracts" value="{{$data['numContracts']}}">
                                   </div>
                                   <div class="form-group">
                                       <label>Period Type</label>
                                       <select class="form-control" name="period_type">
                                           <option value="1">Month</option>
                                            <option value="2">Year</option>

                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Period</label>
                                       <input type="number" class="form-control" name="period" value="{{$data['period']}}">
                                   </div>

                                   <div class="form-group">
                                       <label>Number of Transactions</label>
                                       <input type="number" class="form-control" name="numTransactions" value="{{$data['numTransactions']}}">
                                   </div>
                                   <div class="form-group">
                                       <label>Avg Payload Size in Bytes</label>
                                       <input type="number" class="form-control" name="avgPayloadSizeBytes" value="{{$data['avgPayloadSizeBytes']}}">
                                   </div>

                                   <div class="form-group">

                                       <input type="submit" class="btn btn-primary" value="Calculate Cost"> Estimated Price in USD:{{$price}}
                                   </div>
                               </form>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
