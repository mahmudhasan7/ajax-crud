<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .table-image{
        width: 60px;
        height: 56px;
    }
    .profile-image{
        width: 60px;
        height: 56px;
    }
</style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="alert-message">

                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-flex justify-items-center justify-content-between">Student List
                            <button type="button" class="btn btn-primary add_new">Add New</button>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Profile</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Roll</th>
                                    <th>Reg</th>
                                    <th>Board</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="student-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('ajax-crud.modal')


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"> </script>
  <!-- Jquery cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
    var _token = "{{ csrf_token() }}";

    //students modal
    const Student_Modal = new bootstrap.Modal('#student_modal', {
        keyboard: false,
        backdrop:'static'
    });


    $(document).on('click', 'button.add_new',function(){
        $('form#ajax-form').addClass('ajax-data');
        $('form#ajax-form').removeClass('ajax-update-data');
        Student_Modal.show();

    })
    //form store data
    $(document).on('submit','form.ajax-data',function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ route('ajax.store')  }}",
            data: new FormData(this),
            contentType:false,
            processData:false,
                success: function (response) {
                    if(response.status == 'success'){
                        studentFetchData();
                        $('form.ajax-data')[0].reset();
                        Student_Modal.hide();
                        $('.alert-message').append('<div class="alert alert-success">'+response.message+'</div>');
                    }else{
                        $('.alert-message').append('<div class="alert alert-danger">'+response.message+'</div>');
                    }
                }
        })

    })


        // student fetch data
        function studentFetchData(){

            $.ajax({
                type: "post",
                url: "{{ route('ajax.fetch-data') }}",
                data: {
                    _token:_token
                },
                dataType: "json",
                success: function (response) {
                    $('tbody#student-data').html(response);
                }
            })
        }
        studentFetchData();


        //form Update data
        $(document).on('submit', '.ajax-update-data', function(e){
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ route('ajax.update') }}",
                data: new FormData(this),
                contentType:false,
                processData:false,
                dataType: "json",
                success: function (response) {
                    if(response.status == 'success'){
                        studentFetchData();
                        $('form#ajax-form')[0].reset();
                        Student_Modal.hide();
                        $('.alert-message').append('<div class="alert alert-success">'+response.message+'</div>');

                    }else{
                        $('.alert-message').append('<div class="alert alert-danger">'+response.message+'</div>');
                    }
                }
            });
        })



        //student Data Edit
        $(document).on('click', 'button.edit-btn',function(){
            let student_id = $(this).data('id');
            $('form#ajax-form, #update').val(student_id);
            $('form#ajax-form').addClass('ajax-update-data');
            $('form.ajax-update-data').removeClass('ajax-data');


            $.ajax({
                type: "post",
                url: "{{ route('ajax.edit') }}",
                data: {
                    _token:_token,
                    student_id:student_id
                },
                dataType: "json",
                success: function (response) {
                    if(response){
                        let profile_image_path ="{{asset('images/profile/')}}/"+response.avatar;
                        $('form.ajax-update-data input[name="name"]').val(response.name);
                        $('form.ajax-update-data input[name="email"]').val(response.email);
                        $('form.ajax-update-data input[name="phone"]').val(response.phone);
                        $('form.ajax-update-data input[name="roll"]').val(response.roll);
                        $('form.ajax-update-data input[name="reg"]').val(response.reg);
                        $('form.ajax-update-data .avatar').html('<img src="'+profile_image_path+'" class="profile-image" alt="profile">');

                        Student_Modal.show();
                    }


                }
            });
        });

        //student Delete Data
        $(document).on('click','button.delete-btn',function(){
            let student_id = $(this).data('id');

            $.ajax({
                type: "post",
                url: "{{ route('ajax.destroy') }}",
                data: {
                    _token:_token,
                    student_id:student_id
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == "success"){
                        studentFetchData();
                        $('.alert-message').append('<div class="alert alert-success">'+response.message+'</div>');
                    }

                }
            });
        });


    </script>

</body>

</html>
