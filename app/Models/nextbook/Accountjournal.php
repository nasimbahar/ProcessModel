<?php


    namespace App\Models\nextbook;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Accountjournal extends Nextbookmodel
    {
       use SoftDeletes;

        protected $table = 'account_journal';
      public function currecny(){
          
        return $this->belongsTo(Currency::class, 'currency_id');
       }
         public function payableaccount(){
          
        return $this->belongsTo(Companycharts::class, 'payable_account_id');
       }
       public function recvieableaccount(){
          
        return $this->belongsTo(Companycharts::class, 'receivable_account_id');
       }
         public function debitaccount(){
          
        return $this->belongsTo(Companycharts::class, 'debit_account_id');
       }
        public function creditaccount(){
          
        return $this->belongsTo(Companycharts::class, 'credit_account_id');
       }
        public function project(){
          
        return $this->belongsTo(Projects::class, 'project_id');
    }
    public static function getAccountname($id){
      $data=  Companycharts::where("id",$id)->first();
      if($data!=null){
      return  Companycharts::where("id",$id)->first()->name;
      }
      else{
          return null;
      }
    }
    }


