<?php
Route::get('/', 'Front\WelcomeController@index');

$frontattributes = [
    'prefix'     => config('admin.route.prefix')

];
app('router')->group($frontattributes, function ($router) {
    $router->namespace('Front')->group(function ($router) {
        $router->resource('processmodel/welcome', 'WelcomeController');
        $router->resource('processmodel/phaseone', 'PhaseoneController');
        $router->resource('processmodel/phasetwo', 'PhasetwoController');
        $router->resource('processmodel/phasethree', 'PhasethreeController');
        $router->resource('processmodel/phasefour', 'PhasefourController');
        $router->resource('processmodel/phasefive', 'PhaseFiveController');

        $router->resource('processmodel/oneplatform', 'OnePlatformController');

        $router->get('front/ajax', 'AjaxController@getdetials');

    });

    });



  $attributes = [
            'prefix'     => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ];


      app('router')->group($attributes, function ($router) {
             $router->namespace('Ajax\nextbook')->group(function ($router) {
                $router->get('api/employee', 'EmployeeController@employee');
                $router->get('api/employeeinfo', 'EmployeeController@info');
                $router->get('api/employeeforattendence', 'EmployeeController@employeeforAttendence');
                $router->get('api/employeeforpayroll', 'EmployeeController@employeeforpayroll');
                $router->get('api/autocomplete','AutocompleteController@fetch');

           });

                $router->namespace('nextbook\Projects')->group(function ($router) {
                $router->resource('nextbook/projects', 'ProjectController');
                $router->get('nextbook/newtask', 'ProjectController@newtask');
                $router->get('nextbook/projects/{project}/{delevrable}/edit', 'ProjectdeliverablesController@edit');

           });
          $router->namespace('Back')->group(function ($router) {
              $router->resource("back/consensus", "ConsensusMechanismsController");
              $router->resource("back/programminglanguages", "PrograminglanguageController");
              $router->resource("back/privacy", "PrivacyController");
              $router->resource("back/interoperability", "InteroperabilityController");
              $router->resource("back/resilience", "ResilanceController");
              $router->resource("back/scalability", "ScaliablityController");
              $router->resource("back/contractsupports", "ContractsupportsController");
              $router->resource("back/tokenSupports", "TokenSupportsController");
              $router->resource("back/layersupport", "LayersupportController");

              $router->resource("back/platforms", "PlatformsController");


          });
                $router->namespace('Master')->group(function ($router) {
                $router->resource("phd/bahar","TablesController");
                $router->resource('phd/allpapers', 'AllpapersController');
                $router->resource('phd/year', 'MasterController');
                $router->resource('phd/papertypes', 'MasterController');
                $router->get('phd/getfile/{id}', 'AllpapersController@getfile');
                $router->resource('school/resignstudent', 'MasterController');
                $router->resource('school/gradutestudent', 'MasterController');
                $router->resource('school/classsection','MasterController');
                $router->resource('school/section','MasterController');
                $router->resource('school/tribe','MasterController');
                $router->resource('school/nativelanguage','MasterController');
                $router->resource('school/shift','MasterController');
                $router->resource('school/gridaction','MasterController');
                $router->resource("school/studentadditioninfo","MasterController");

                $router->resource('school/driver', 'MasterController');
                $router->resource('school/vehicle', 'MasterController');
                $router->resource('school/region', 'MasterController');
                $router->resource('school/fee', 'MasterController');
                $router->resource('school/months', 'MasterController');

                $router->resource('school/langfiles', 'AllLangFilesController');
                $router->get("langstring/view/{filename}","LangStringsController@grid");

                //////
                $router->post("school/update/address/9","ExtraFieldsWithRelationsController@handle");
                $router->get("api/cascading/district","AjaxController@casecadingfield");
                $router->get("api/cascading/classsection","AjaxController@classsection");




//////////////////////////////////////////////////////////////////////////////////////
                $router->get("school/database/{table}","DatabaseController@index");
                $router->get("school/lang/{table}","DatabaseController@getlang");


           });

                $router->namespace('nextbook\Customers')->group(function ($router) {
                $router->resource('nextbook/customers', 'CustomerController');



           });
              $router->namespace('nextbook\Products')->group(function ($router) {
                $router->resource('nextbook/products', 'ProductsController');
                 $router->resource('nextbook/store', 'StoreController');

           });
             $router->namespace('nextbook\Vendors')->group(function ($router) {
                $router->resource('nextbook/vendor', 'VendorController');

           });
              $router->namespace('nextbook\Employee')->group(function ($router) {

              $router->resource('nextbook/employee', 'EmployeeController');
              $router->resource('nextbook/payroll', 'PayrollController');
              $router->post('payroll/savepayroll', 'PayrollController@savepayroll');
               $router->put('payroll/updatepayroll', 'PayrollController@updatepayroll');

              $router->resource('nextbook/employeeaditionalpayment', 'EmployeeaditionalpaymentsController');
              $router->resource('nextbook/attendece', 'EmployeeAttendenceController');
             $router->post('employee/attendencesave', 'EmployeeAttendenceController@attendencesave');

           });




               $router->namespace('nextbook\Accounts')->group(function ($router) {
               $router->resource('nextbook/capitalaccounts', 'CaptialaccountsController');
                $router->resource('nextbook/journaltransactions', 'JournaltransectionController');
           });
                $router->namespace('nextbook\Assets')->group(function ($router) {
               $router->resource('nextbook/assets', 'AssetsController');
           });
            $router->namespace('nextbook\Invoices')->group(function ($router) {
               $router->resource('nextbook/invoices', 'InvoiceController');
                $router->get('nextbook/invoicepayment/{id}/{expenseid}/edit', 'InvoicepaymentController@edit');
               $router->get('nextbook/invoicepayment/{id}/create','InvoicepaymentController@create');
               $router->get('nextbook/invoicepayment/{id}','InvoicepaymentController@index');
               $router->get('nextbook/getprodcutprice/{id}','InvoicepaymentController@index');
                $router->get('nextbook/getprice','InvoiceController@getprice');

           });

            $router->namespace('nextbook\Qoutation')->group(function ($router) {
               $router->resource('nextbook/qoutation', 'QuotationController');
           });
             $router->namespace('nextbook\Pointofsale')->group(function ($router) {
               $router->get('nextbook/pointofsale', 'PointofsaleController@loadpointofsale');
                $router->get('nextbook/loadproducts', 'PointofsaleController@products');
           });

               $router->namespace('nextbook\Expenses')->group(function ($router) {
               $router->resource('nextbook/expenses', 'ExpensesController');
               $router->get('nextbook/expensepayment/{id}/{expenseid}/edit', 'ExpensepaymentController@edit');
               $router->get('nextbook/expensepayment/{id}/create','ExpensepaymentController@create');
               $router->get('nextbook/expensepayment/{id}','ExpensepaymentController@index');
                $router->post('nextbook/expensepayment/{id}','ExpensepaymentController@store');
             // $router->resource('nextbook/expensepayment/{id}', 'ExpensepaymentController');

           });
               $router->namespace('nextbook\Reports')->group(function ($router) {
               $router->resource('nextbook/ledgerreport', 'LedgerController');
               $router->resource('nextbook/balancesheetreport', 'BalanceSheetController');
               $router->resource('nextbook/netincomereport', 'NetIncomeController');


           });






        });
        $attributes2 = [
            'prefix'     => config('admin.route.prefix')
        ];

        app('router')->group($attributes2, function ($router) {

              $router->namespace('Auth')->group(function ($router) {
              $router->resource('auth/auths', 'AuthController');
              $router->get('auth/login', 'AuthController@getLogin');
              $router->get('auth/register', 'AuthController@getRegister');
              $router->post('auth/register', 'AuthController@postRegister');
           });



        });
