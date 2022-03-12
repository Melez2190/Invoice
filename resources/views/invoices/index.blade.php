@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <div class="ml-48">
        <a href="javascript:void(0)" id="createNewInvoice" class=" bg-blue-500  absolute right-8 top-24 px-8 text-white shadow-5xl mb-10 p-2 uppercase font-bold">Add New Invoice</a>

        <div class="block inline-block input-daterange ">
            <div class="inline-block w-36">
                <input type="date" name="from_date" id="from_date" class="p-2" placeholder="From Date"  />
            </div>
            <div class="inline-block w-36">
                <input type="date" name="to_date" id="to_date" class="p-2" placeholder="To Date"  />
            </div>
            <div class="inline w-48">
                <button type="button" name="filter" id="filter" class=" bg-blue-500 w-24  ml-8 text-white shadow-5xl mb-10 p-2 uppercase font-bold">Filter</button>
                <button type="button" name="refresh" id="refresh" class=" bg-green-500 w-24 ml-2 text-white shadow-5xl mb-10 p-2 uppercase font-bold">Refresh</button>
            </div>
        </div>
     
        
        <table id="invoicetable" class="mb-12 mt-4 w-full table table-hover dataTable table-custom table-striped m-b-0 c_list">

            <thead>
                <tr class="text-left border-b-6 p-4">
                    <th class="border-separate border-b-2">Client</th>
                    <th class="border-b-2">Date of Issue</th>
                    <th class="border-b-2">Valuta</th>
                    <th class="border-b-2">Status</th>
                    <th class="border-b-2">Action</th>
                    
                
                </tr>
            </thead>
            <tbody></tbody>
        </table>

         <!-- Main modal -->
  <div id="invoiceModal"  aria-hidden="true" class=" ajaxModal  hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full  mx-auto max-w-md h-full md:h-auto">
       
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
         
            <div class="flex justify-end p-2">
                <button type="button" class="closeModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"  >
                   
                    <svg class="w-5 h-5 closeModal" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8 bg-white" id="invoiceForm" name="invoiceForm">
                @csrf
                <input type="hidden" name="invoice_id" id="invoice_id">

                <h3 id="modalHeading" class="text-xl font-medium text-gray-900 dark:text-white"></h3>
                <div>
                        {{-- <input type="text" name="company_name" id="company_name" placeholder="company_name"> --}}
                            
                          <select id='sel_cli' style='width: 200px;'>
                            <option  value='0'>-- Select Client --</option>
                         </select>
                      
                   
                </div>
                <div>
                    <label for="date_of_issue" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                    <input type="date" name="date_of_issue" id="date_of_issue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                </div>
                <div>
                  <label for="valuta" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">City</label>
                  <input type="date" name="valuta" id="valuta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
              </div>
            

                <button type="submit" id="saveBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="create">Save</button>

                <button type="submit" id="editBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="create">Edit</button>


            </form>
        </div>
    </div>
</div>



         <!-- Items modal -->

<div id="itemsModal"  aria-hidden="true" class="  hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    
    <div class="relative px-4 w-11/12 px-8 ml-auto mr-auto h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white px-8 rounded-lg shadow dark:bg-gray-700">
           
            <div class="flex justify-end p-2">
                <a href="javascript:void(0)" id="createNewItem" class=" bg-blue-500 mr-auto mt-4 px-8 text-white shadow-5xl mb-10 p-2 uppercase font-bold">Add New Item</a>
                <button type="button" class="closeItemsModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"  >
                    <svg class="w-5 h-5 closeItemsModal" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
          
            <table id="itemsTable" name="itemsTable" class="mb-12 mt-4 w-full table table-hover dataTable table-custom table-striped m-b-0 c_list" style=""> 
                <thead>
                    <tr>    
                        <th >Description</th>
                        <th >Quantity</th>
                        <th style="width: 100px">Price</th>
                        <th >Pdv</th>
                        <th style="width: 150px" >Total</th>
                        <th >Action</th>

                        

                    </tr>

                   
                </thead>
              
                <tbody>
               
                </tbody>
             
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right">Total:</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
          
          
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div id="editItemModal"  aria-hidden="true" class=" editItemModal  hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full  mx-auto max-w-md h-full md:h-auto">
       
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
         
            <div class="flex justify-end p-2">
                <button type="button" class="closeEditItemModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"  >
                   
                    <svg class="w-5 h-5 closeModal" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8 bg-white" id="itemForm" name="itemForm">
                @csrf
                <input type="hidden" name="invoice_id" id="invoice_id" >
                <h3 id="modalHeading" class="text-xl font-medium text-gray-900 dark:text-white"></h3>
              
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                    <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                </div>
                <div>
                  <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Quantity</label>
                  <input type="integer" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
              </div>
              <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Price</label>
                <input type="integer" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
            </div>
            <div>
                <label for="pdv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pdv</label>
                <input type="number" name="pdv" id="pdv" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
            </div>
            

                <button type="submit" id="item-saveBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="create">Save</button>

                <button type="submit" id="editItemBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="create">Edit</button>


            </form>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="deleteInvoicemodal">
    <div class="relative px-4 w-full max-w-md h-full ml-auto mr-auto top-32 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button type="button" class=" cancelBtn text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 pt-0 text-center">
                <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this invoice?</h3>
                <button id="okDelete" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button type="button" class="cancelBtn-invoice text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">No, cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Item Modal -->
<div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="itemdeletemodal">
    <div class="relative px-4 w-full max-w-md h-full ml-auto mr-auto top-32 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button type="button" class=" cancelBtn-item text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 pt-0 text-center">
                <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this item?</h3>
                <button id="itemokDelete" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button type="button" class="cancelBtn-item text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">No, cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')


<script type="text/javascript">
    var invoice_id

        $(document).ready(function(){
           

        load_data();

        function load_data(from_date = '', to_date = '')
    {
        var table = $('#invoicetable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:route("invoices.index"),
            data: function(d) {
                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
            }
        },
        
    
        columns: [
          
            {"data": 'client.name',"name":'client.name' },
            {"data": 'date_of_issue',"name":'date_of_issue', "searchable": true },
            {"data": 'valuta',"name":'valuta' },
            {"data": 'status',"name":'status' },
            {
                "data": 'action',
                "name": 'action',
                "orderable": true,
                "searchable": true
            }
        ],
       
                

        });
    }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
                {
                $('#invoicetable').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                alert('Both Date is required');
            }
            });

            $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#invoicetable').DataTable().destroy();
            load_data();
            });


            $("#createNewInvoice").click(function(){
            $("#invoice_id").val('');
            $("#invoiceForm").trigger("reset");
            $('#modalHeading').html("Add Invoice");
            $('#invoiceModal').modal('show');
        });

     

});
        $(document).ready(function(){

            $( "#sel_cli" ).select2({
                ajax: { 
                url: route('getInvoicesClient'),
                type: "post",
                dataType: 'json',
                delay: 250,
              
                data: function (params) {
                    return {
                    _token: "{{ csrf_token() }}",
                    search: params.term 
                    };
                },
                processResults: function (id) {
                    return {
                    results: id
                    };
                },
                cache: true
                }

            });

        });

        $("#saveBtn").click(function(e){
            e.preventDefault();
            var client = $('#sel_cli').val();
            var date_of_issue = $('#date_of_issue').val();
            var valuta = $('#valuta').val();

            let formData = $("#invoiceForm").serialize();
            $.ajax({
                type: "POST",
                url :route('invoices.store', invoice_id) ,
                data: {date_of_issue, valuta,  client, _token:"{{ csrf_token() }}"},
                success:function(data){
                    $("#invoiceForm").trigger("reset");
                    $('#invoiceModal').modal('hide');
                    $('#invoicetable').DataTable().ajax.reload();
                 }
            });


        });
      

        $(document).on('click', '.closeModal', function (e) {
             $('#invoiceModal').modal('hide');
        });


        $("#editBtn").click(function(e){
             e.preventDefault();

            $(this).html('Edit');

            let formData = $("#invoiceForm").serialize();

            $.ajax({
                url :route('invoices.update', invoice_id) ,
                type: "PUT",
                data: formData,
                success:function(data){
                    $("#invoiceForm").trigger("reset");
                    $('#invoiceModal').modal('hide');
                    $('#invoicetable').DataTable().ajax.reload();
                 },
                 error: function(data){

                // Log in the console
                var errors = data.responseJSON;
                console.log(errors);
                 }
            });


        });


        $(document).on('click', '.btn-edit', function(e){   
            
            $('#modalHeading').html("Edit Invoice");

            invoice_id = $(this).data('id');

            $.ajax({
                url :route('invoices.edit', invoice_id) ,
                type: "GET",
                dataType: 'json',
                success:function(data){
                    $("#client_id").val(data.client_id);
                    $("#date_of_issue").val(data.date_of_issue);
                    $("#valuta").val(data.valuta);
                }
            });

            $('#invoiceModal').modal('show');

        });




        $(document).on('click', '.btn-delete', function(){
            invoice_id = $(this).data('id');
            $('#deleteInvoicemodal').modal('show')

        });
        $("#okDelete").click(function(){
        
            $.ajax({
                data: {
                    _token: "{{ csrf_token() }}"
                },
                type: "DELETE",
                url: route('invoices.destroy', invoice_id),
                beforeSend:function(){
                        $('#okDelete').text('Deleting...');
                    },
                success:function(data){
                    setTimeout(function(){
                        $('#deleteInvoicemodal').modal('hide');
                        $('#invoicetable').DataTable().ajax.reload();
                        $('#okDelete').text("Yes, I'm sure");

                    }, 500);

                },


            });
        });



        $(document).on('click', '.btn-paid', function(){
            let sid = $(this).data('id');
            let table = $('#invoicetable').DataTable();
            let status = table.row( $(this).closest('tr') ).data()['status'];

            
            $.ajax({
                type: "GET",
                url: route('invoice.changestatus', sid),
                   
                data: { _token: "{{ csrf_token() }}",
                    status:  table.row( $(this).closest('tr') ).data()['status'],
                    id:sid
                },
               success: function(response) {
                $('#invoicetable').DataTable().ajax.reload();

            }
        });
        });
  
    // Item DataTable
        
     $(document).on('click', '#btn-view', function(e){
        e.preventDefault();

        $('#itemsModal').modal('show');
       
        invoice_id = $(this).data('id');

            $('#itemsTable').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
 
            // Formating number for calculation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            
          
                
            // Total  this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
               
            // Total all pages
                total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Formating number to a money currency
                let formatted = new Intl.NumberFormat("en-RS", {
                style: 'currency',
                currency: 'RSD'
                }).format(pageTotal);

                let formatTotal =  new Intl.NumberFormat("en-RS", {
                style: 'currency',
                currency: 'RSD'
                }).format(total);
            // Update footer

            $( api.column( 4 ).footer() ).html(
               
                formatted  +'( '+ formatTotal +' )'
            );
           
        },
                ajax: route('items.show', invoice_id),
                columns: [
                    {"data" : "description"},
                    {"data" : "quantity"},
                    {"data" : "price"},
                    {"data" : "pdv"},
                    {
                        "data": 'total',
                        "name": 'total',
                        "orderable": true,
                        "searchable": true
                },
                {
                        "data": 'action',
                        "name": 'action',
                        "orderable": true,
                        "searchable": true,
                        "width": "25%"
                },
                ],
                success:function(data){
                    // $('#itemsTable').DataTable().destroy();
                 
                 }
            });
          

            $("#createNewItem").click(function(){
            $("#item_id").val('');
            $("#itemForm").trigger("reset");
            $('#modalHeading').html("Add Item");
            $('#editItemModal').modal('show');
        });
    });


    $(document).on('click', '.closeItemsModal', function (e) {
            $('#itemsModal').modal('hide');
            $('#itemsTable').DataTable().destroy();
     });



     $(document).on('click', '.btn-edit-item', function(e){   
            
            $('#modalHeading').html("Edit Item");

            item_id = $(this).data('id');

            $.ajax({
                url :route('items.edit', item_id) ,
                type: "GET",
                dataType: 'json',
                success:function(data){
                    $("#description").val(data.description);
                    $("#quantity").val(data.quantity);
                    $("#price").val(data.price);
                    $("#pdv").val(data.pdv);
                }
            });

            $('#editItemModal').modal('show');

        });

        $("#editItemBtn").click(function(e){
             e.preventDefault();

            $(this).html('Edit');

            let formData = $("#itemForm").serialize();

            $.ajax({
                url :route('items.update', item_id) ,
                type: "PUT",
                data: formData,
                success:function(data){
                    $("#itemForm").trigger("reset");
                    $('#editItemModal').modal('hide');
                    $('#itemsTable').DataTable().ajax.reload();
                 },
                 error: function(data){

                // Log in the console
                var errors = data.responseJSON;
                console.log(errors);
                 }
            });


        });

        $(document).on('click', '.btn-delete-item', function(){
            item_id = $(this).data('id');
            $('#itemdeletemodal').modal('show')

        });
        $("#itemokDelete").click(function(){
        
            $.ajax({
                data: {
                    _token: "{{ csrf_token() }}"
                },
                type: "DELETE",
                url: route('items.destroy', item_id),
                beforeSend:function(){
                        $('#itemokDelete').text('Deleting...');
                    },
                success:function(data){
                    setTimeout(function(){
                        $('#itemdeletemodal').modal('hide');
                        $('#itemsTable').DataTable().ajax.reload();
                        $('#itemokDelete').text("Yes, I'm sure");

                    }, 500);

                },


            });
        });


        $("#item-saveBtn").click(function(e){
            e.preventDefault();
            var description = $('#description').val();
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            var pdv = $('#pdv').val();
           

            let formData = $("#itemForm").serialize();
            $.ajax({
                type: "POST",
                url :route('items.store') ,
                data: {invoice_id, description, quantity, price, pdv, _token:"{{ csrf_token() }}" },
                  
                
                success:function(data){
                    $("#itemForm").trigger("reset");
                    $('#editItemModal').modal('hide');
                    $('#itemsTable').DataTable().ajax.reload();
                 }
            });


        });


        // $("#saveBtn").click(function(e){
        //     e.preventDefault();
        //     var client = $('#sel_cli').val();
        //     var date_of_issue = $('#date_of_issue').val();
        //     var valuta = $('#valuta').val();

        //     let formData = $("#invoiceForm").serialize();
        //     $.ajax({
        //         type: "POST",
        //         url :route('invoices.store', invoice_id) ,
        //         data: {date_of_issue, valuta,  client, _token:"{{ csrf_token() }}"},
        //         success:function(data){
        //             $("#invoiceForm").trigger("reset");
        //             $('#invoiceModal').modal('hide');
        //             $('#invoicetable').DataTable().ajax.reload();
        //          }
        //     });


        // });

        $(document).on('click', '.closeEditItemModal', function (e) {
            $('#editItemModal').modal('hide');
        });

        $(document).on('click', '.cancelBtn-item', function (e) {
                $('#itemdeletemodal').modal('hide');
        });

        $(document).on('click', '.cancelBtn-invoice', function (e) {
                $('#deleteInvoiceModal').modal('hide');
        });
            
 </script>

@endsection