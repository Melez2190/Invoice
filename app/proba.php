
@extends('layouts.master')
@push('css')
    <style>
        .buttons-colvis{
            margin-top:20px;
        }
    </style>
    @endpush
@section('content')
<div class="modal" id="new-comment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">{{ __('Add comment for client') }}</h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <input type="hidden" name="client_id" id="client_id">
                    <x-textarea
                        name="comment"
                        id="comment"
                        label="{{ __('Comment') }}"
                        type="text"
                        size="12"
                        rows="8"
                    />

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary add-comment-button">{{ __('Add comment') }}</button>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="all-comment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">{{ __('Comments') }}</h6>
            </div>
            <div class="modal-body">
                <div class="clearfix comments-list">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>

            </div>
        </div>
    </div>
</div>
<div class="modal" id="import" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">{{ __('Import clients') }}</h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <form class="col-md-12" method="POST" action="{{ route('clients.import') }}"
                          aria-label="{{ __('Add Clients') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Excel file')}}</label>
                                <input type="file" name="file"
                                       class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Excel file')}}">
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>

            </div>
        </div>
    </div>
</div>
<div class="modal" id="schedule-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">{{ __('Call again on selected date') }}</h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <input type="hidden" name="client_id" id="client_id">
                    <x-datepicker
                        name="schedule_at"
                        id="schedule_at"
                        label="{{ __('Schedule at') }}"
                        type="text"
                        size="12"
                        rows="8"
                    />

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary schedule-button">{{ __('Schedule') }}</button>

            </div>
        </div>
    </div>
</div>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                class="fa fa-arrow-left"></i></a> {{ __('Client List') }}</h2>
                    <a href="{{ route('clients.create') }}" class="btn btn-xs btn-primary pull-right">{{ __('Add New Client') }}</a>
                    <a href="#" class="btn btn-xs btn-warning pull-right import mr-1" data-toggle="modal" data-target="#import">{{ __('Import') }}</a>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">{{ __('Client') }}</li>
                        <li class="breadcrumb-item active">{{ __('Client List') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table id="clients" class="table table-hover dataTable table-custom table-striped m-b-0 c_list" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Name' ) }}</th>
                                        <th>{{ __('Address' ) }}</th>
                                        <th>{{ __('City' ) }}</th>
                                        <th>{{ __('Size' ) }}</th>
                                        <th>{{ __('Activity' ) }}</th>
                                        <th>{{ __('Email' ) }}</th>
                                        <th>{{ __('Phone' ) }}</th>
                                        <th>{{ __('Web' ) }}</th>
                                        <th>{{ __('PIB' ) }}</th>
                                        <th>{{ __('Country' ) }}</th>
                                        <th>{{ __('Contact person' ) }}</th>
                                        <th>{{ __('Comments' ) }}</th>
                                        <th>{{ __('Offers' ) }}</th>
                                        <th>{{ __('Scheduled at' ) }}</th>

                                        <th>{{ __('Action' ) }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
    var clients = $('#clients').DataTable({
        "ajax": "{{ route('clients.index') }}",
        "responsive": true,
        stateSave: true,
        'dom': '<"top"lfB>t<"bottom"ip><"clear">',
        'buttons': [
            'colvis',
        ],
        language: {
            buttons: {
                colvis: "{{ __('Columns') }}"
            }
        },
        "columns": [
            {"data": "id", "width": "5%", "visible": false},
            {"data": "name", "width": "10%"},
            {
                data: null,
                "width"     : "10%",
                "render": function ( data, type, row ){
                    if(row.postal_code){
                        return  row.postal_code+' '+row.address ;
                    }
                    return row.address;
                }
            },
            {"data": "city"},
            {"data": "size"},
            {"data": "activity"},
            {"data": "email"},
            {"data": "phone"},
            {
                data: null,
                "width"     : "10%",
                "render": function ( data, type, row ){
                    if(row.web){
                        return '<a href="http://'+row.web+'" target="_blank">'+row.web+'</a>';
                    }
                    return '';
                }
            },
            {"data": "pib"},
            {"data": "country.name", "visible": false},
            {"data": "contact_person", "visible": false},
            {
                data: null,
                "width"     : "10%",
                "render": function ( data, type, row ){
                    if(row.client_comments){

                        var color = 'badge-warning';
                        if(row.comments_number > 0){
                            color = 'badge-primary';
                        }
                        return '<a href="#" title="" class="badge '+color+' all-comments" data-id="' + row.id + '">'+row.comments_number+'</a>';
                    }
                    return '';
                }
            },
            {
                data: null,
                "width"     : "10%",
                "render": function ( data, type, row ){
                    if(row.client_offers){
                        var color = 'badge-warning';
                        if(row.offers_number > 0){
                            color = 'badge-success';
                        }
                        return '<a href="#" title="" class="badge  '+color+'" data-id="' + row.id + '">'+row.offers_number+'</a>';
                    }
                    return '';
                }
            },
            {"data": "schedule_at"},
            {
                data: null,
                "width"     : "10%",
                "render": function ( data, type, row ){
                    if(!row.has_account){
                        var editRoute = route('clients.edit', row.id);
                        return '<a href="'+ editRoute + '" class="btn btn-sm btn-outline-primary" title=""><i class="fa fa-edit"></i></a>' +
                                '<button class="btn btn-sm btn-outline-warning comment-button" title="Comment" data-id="' + row.id + '" data-type="confirm"><i class="fa fa-comment-o"></i></button>'+
                                '<button class="btn btn-sm btn-outline-warning schedule" title="Schedule call" data-id="' + row.id + '" data-type="confirm"><i class="fa fa-calendar"></i></button>' +
                                '<button class="btn btn-sm btn-outline-danger send-email" title="Email" data-id="' + row.id + '" data-type="confirm"><i class="fa fa-envelope"></i></button>';
                    }

                    return '';
                    }
            },
        ],
        "order": [[1, 'DESC']],
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 15 },
            { responsivePriority: 3, targets: 12 },
            { responsivePriority: 4, targets: 13 },
            { responsivePriority: 5, targets: 14 },
            { responsivePriority: 6, targets: 3 },

        ]
    });

    $(document).on('click', '.comment-button', function (e) {
        var client = $(this).attr('data-id');
        $('#client_id').val(client);
        $('#new-comment').modal('show');
    });

        $(document).on('click', '.schedule', function (e) {
            var client = $(this).attr('data-id');
            $('#client_id').val(client);
            $('#schedule-modal').modal('show');
        });

    $(document).on('click', '.all-comments', function (e) {
        var client = $(this).attr('data-id');
        $.ajax({
            url: route('clients.comments', client),
            type: 'GET'
        })
        .done(function(response) {
            $('.comments-list').html(response);
        });
        $('#all-comment').modal('show');
    });

    $('.add-comment-button').on('click', function (){
        var button = $(this);
        button.prop('disabled', true);
        $.ajax({
            url: route('clients.comment'),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                'comment': $('#comment').val(),
                'client_id': $('#client_id').val(),
            }
        })
        .done(function() {
            swal("{{ _('Successful!')}}", "{{ _('Comment added.') }}", "success");
            $('#new-comment').modal('hide');
            clients.ajax.reload();
            button.prop('disabled', false);
            $('#comment').val('');

        });
    });

        $('.schedule-button').on('click', function (){
            var button = $(this);
            button.prop('disabled', true);
            $.ajax({
                url: route('clients.schedule', $('#client_id').val()),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    'schedule_at': $('#schedule_at').val(),
                }
            })
                .done(function() {
                    swal("{{ _('Successful!')}}", "{{ _('Schedule added.') }}", "success");
                    $('#schedule-modal').modal('hide');
                    clients.ajax.reload();
                    button.prop('disabled', false);
                    $('#schedule_at').val('');

                });
        });

    $('#clients').on('click', '.send-email', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        swal({
        title: "{{ __('Are you sure?') }}",
        text: "{{ __('Send offer to the company!') }}",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        confirmButtonText: "{{ __('Yes, send it!') }}",
        closeOnConfirm: false
        }, function () {
            swal("{{ _('Sent!')}}", "{{ _('Offer is sent successfully.') }}", "success");
            $.ajax({
                url: "/billing/clients/"+id+"/offer",
                type: 'POST',
                data: {
                _token: '{{ csrf_token() }}'
                }
            })
            .done(function() {
                clients.ajax.reload();
            });
        });
      });
    });
</script>
@endpush