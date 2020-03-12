@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Add Fees
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('account.fees.includes.buttons')
                        @include('includes.flash_messages')
                        {!! Form::open(['route' => 'account.fees.quick-receive.store', 'method' => 'POST', 'class' => 'form-horizontal',
                        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                        @include('account.fees.quickreceive.includes.form')
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            //fee-detail-form
            document.getElementById('fee-detail-form').style.display = 'none';

            /*date*/
           /* var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!

            var yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd;
            }
            if(mm<10){
                mm='0'+mm;
            }
            var today = yyyy +'-'+mm+'-'+ dd;
            $("#date").val( today );*/

            /*Find Student*/
            $('select[name="students_id"]').select2({
                placeholder: 'Search Student...',
                ajax: {
                    url: '{{ route('student.student-name-autocomplete') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            /*Student Verify*/
            $('#load-html-btn').click(function () {
                $('#student_wrapper').empty();
                var students_id = $('select[name="students_id"]').val();
                if (!students_id)
                    toastr.warning("Please, Choose Student.", "Warning");
                else {

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('account.student-detail-html') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: students_id
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);

                            if (data.error) {
                            } else {

                                $('#student_wrapper').append(data.html);
                                document.getElementById('fee-detail-form').style.display = 'block';
                            }
                        }
                    });

                }
            });

            /*Fees Verification */
            $('#add-collection').click(function () {
                //studentDue
                var studentDue = $('input[name="studentDue"]').val();
                var receive_amount = $('input[name="receive_amount"]').val();
                var discount_amount = $('input[name="discount_amount"]').val();
                var date = $('input[name="date"]').val();
                if(!studentDue){
                    toastr.warning('Find and Verify Student.','Warning:');
                    return false;
                }else{
                    if(!date){
                        toastr.warning('Enter Receive Date.','Warning:');
                        return false;
                    }

                    if(!receive_amount){
                        toastr.warning('Enter Your Receive Amount.','Warning:');
                        return false;
                    }

                    $totalreceive = (Number(receive_amount) + Number(discount_amount));

                    $status = studentDue - $totalreceive;

                    if($status < 0){
                        toastr.warning('Student Due Amount is:'+studentDue+'. You want to Collect Amount/Discount '+$totalreceive+' . That is Greater Than Due Amount.', "Warning");
                        return false;
                    }else if(receive_amount < studentDue){

                    }else {
                        return true;
                    }
                }
            });

            function verifyStudent() {
                $('#student_wrapper').empty();
                var students_id = $('select[name="students_id"]').val();
                if (!students_id)
                    toastr.warning("Please, Choose Student.", "Warning");
                else {

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('account.student-detail-html') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: students_id
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);

                            if (data.error) {
                            } else {

                                $('#student_wrapper').append(data.html);
                                document.getElementById('fee-detail-form').style.display = 'block';
                            }
                        }
                    });

                }
            }

        });

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')

@endsection