<section class="printOnly" style="margin: 0px; padding: 0px;">
     <table class="table table-striped">
         <tr>
             <td>


          <h2 class="page-header">
              <i class=""></i> <?php echo \App\Models\nextbook\Company::name();?>

          </h2>


      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-12 ">
            <label class="form-label"><?php echo __("company.website")."  : ".\App\Models\nextbook\Company::websitee()?></label>
            <br>
            <label ><?php echo __("company.email")."  : ".\App\Models\nextbook\Company::emaill()?></label>
            <br>
            <label ><?php echo __("company.contactnumber")."  : ".\App\Models\nextbook\Company::contactnumberr()?></label>
            <br>
            <label ><?php echo __("company.address")."  : ".\App\Models\nextbook\Company::addresss()?></label>

      </div>
             </td>
             <td>
                   <small class="pull-right">Date: <?php echo date("y/m/d");?></small>
                   <div style="margin-top: 40px" class="pull-right"> <?php echo \App\Models\nextbook\Company::companylogo();?></div>
             </td>
     </table>



    </section>