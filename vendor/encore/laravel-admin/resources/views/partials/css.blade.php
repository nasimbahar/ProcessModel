@foreach($css as $c)
    <link rel="stylesheet" href="{{ admin_asset("$c") }}">
@endforeach
<link href="{{admin_asset('css/print.css')}}" rel="stylesheet" type="text/css" media="print"/>
<style type="text/css">
    
    .printOnly {
   display : none;
}
    
   @media print {
  a[href]:after {
    content: none !important;
  }
  footer{
      display: none !important;
  }
    body {
    margin: 0;
    color: #000;
    background-color: #fff;
  }
 button,a {
    visibility: hidden;
  }
  li.active >a{
       visibility: visible;
  }
  div.box-footer{
      visibility:hidden;
  }



    .printOnly {
       display : block;
    }

}
 
 
 </style>