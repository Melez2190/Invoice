@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection
@section('content')
    <div class="ml-48">
        <a href="javascript:void(0)" id="createNewClient" class=" bg-blue-500  absolute right-8 top-24 px-8 text-white shadow-5xl mb-10 p-2 uppercase font-bold">Add New Client</a>
       
        <table id="clientsTable" class="mb-12 mt-4 w-full table table-hover dataTable table-custom table-striped m-b-0 c_list" style="width:100%">

            <thead>
                <tr class="text-left border-b-6 p-4">
                    <th class="border-separate border-b-2">Name</th>
                    <th class="border-b-2">City</th>
                    <th class="border-b-2 w-1/12">Address</th>
                    <th class="border-b-2 w-2/12">Account Number</th>
                    <th class="border-b-2 w-2/12">Email</th>
                    <th class="border-b-2 w-2/12 edit">Action</th>

                </tr>
            </thead>
            <tbody>
            </tbody>

        </table>




  <!-- Main modal -->
  <div id="ajaxModal"  aria-hidden="true" class=" ajaxModal hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
      <div class="relative px-4 w-full  mx-auto max-w-md h-full md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

              <div class="flex justify-end p-2">

                  <button type="button" class="closeModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"  >
                      <svg class="w-5 h-5 closeModal" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  </button>
              </div>
              <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" id="clientForm" name="clientForm">
                  @csrf
                  <input type="hidden" name="client_id" id="client_id">
                  <h3 id="modalHeading" class="text-xl font-medium text-gray-900 dark:text-white"></h3>
                  <div>
                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                      <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                  </div>
                  <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">City</label>
                    <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                </div>
                <div>
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Address</label>
                    <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                </div>
                <div>
                    <label for="account_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account Number</label>
                    <input type="text" name="account_number" id="account_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                </div>
                <div>
                    <label for="id_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Id Number</label>
                    <input type="id_number" name="id_number" id="id_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                </div>
                  <div>
                      <label for="tax_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tax Number</label>
                      <input type="text" name="tax_number" id="tax_number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                  </div>
                  <div>
                    <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Zip code</label>
                    <input type="text" name="zip_code" id="zip_code"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                 <div>
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Phone Number</label>
                    <input type="phone" name="phone_number" id="phone_number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>

                  <button type="submit" id="saveBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="create">Save</button>

                  <button type="submit" id="editBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="create">Edit</button>


              </form>
          </div>
      </div>
  </div>



  <!-- Delete Product Modal -->
  <div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="deletemodal">
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
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this client?</h3>
                  <button id="okDelete" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                      Yes, I'm sure
                  </button>
                  <button type="button" class="cancelBtn text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">No, cancel</button>
              </div>
          </div>
      </div>
  </div>

@endsection
@section('javascript')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>



<script type="text/javascript">
    var client_id
    $(document).ready( function () {
        $('#clientsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: route('clients.index'),
            columns: [
                {"data": 'name',"name":'name'},
                {"data": 'city',"name":'city' },
                {"data": 'address',"name":'address' },
                {"data": 'account_number',"name":'account_number' },
                {"data": 'email', "width":"400px","name":'email'},
                {
                    "data": 'action',
                    "name": 'action',
                    "orderable": true,
                    "searchable": true
                }
            ]
        });

        $("#createNewClient").click(function(){
            $("#student_id").val('');
            $("#clientForm").trigger("reset");
            $('#modalHeading').html("Add Client");
            $('#ajaxModal').modal('show');
        });
    
 });

 
        $("#saveBtn").click(function(e){
            e.preventDefault();


            let formData = $("#clientForm").serialize();

            $.ajax({
                type: "POST",
                url :route('clients.store', client_id) ,
                data: formData,
                success:function(data){
                    $("#clientForm").trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $('#clientsTable').DataTable().ajax.reload();
                 }
            });


        });
     
        
        $(document).on('click', '.closeModal', function (e) {
             $('#ajaxModal').modal('hide');
        });

        
        
        $("#editBtn").click(function(e){
             e.preventDefault();

            $(this).html('Edit');

            let formData = $("#clientForm").serialize();

            $.ajax({
                url :route('clients.update', client_id) ,
                type: "PUT",
                data: formData,
                success:function(data){
                    $("#clientForm").trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $('#clientsTable').DataTable().ajax.reload();
                 },
                 error: function(data){

                // Log in the console
                var errors = data.responseJSON;
                console.log(errors);
                 }
            });


        });
        
        $(document).on('click', '.btn-edit', function(e){   
            
            $('#modalHeading').html("Edit Client");

            client_id = $(this).data('id');
            $.ajax({
                url :route('clients.edit', client_id) ,
                type: "GET",
                dataType: 'json',
                success:function(data){
                    $("#name").val(data.name);
                    $("#city").val(data.city);
                    $("#address").val(data.address);
                    $("#account_number").val(data.account_number);
                    $("#id_number").val(data.id_number);
                    $("#tax_number").val(data.tax_number);
                    $("#zip_code").val(data.zip_code);
                    $("#email").val(data.email);
                    $("#phone_number").val(data.phone_number);
                }
            });

            $('#ajaxModal').modal('show');

        });
   


        $(document).on('click', '.btn-delete', function(){
            client_id = $(this).data('id');
            $('#deletemodal').modal('show')

        });
        $("#okDelete").click(function(){
        
            $.ajax({
                data: {
                    _token: "{{ csrf_token() }}"
                },
                type: "DELETE",
                url: route('clients.destroy', client_id),
                beforeSend:function(){
                        $('#okDelete').text('Deleting...');
                    },
                success:function(data){
                    setTimeout(function(){
                        $('#deletemodal').modal('hide');
                        $('#clientsTable').DataTable().ajax.reload();
                        $('#okDelete').text("Yes, I'm sure");

                    }, 500);

                },


            });
        });
    $(document).on('click', '.cancelBtn', function (e) {
        $('#deletemodal').modal('hide');
    });



  

</script>

@endsection