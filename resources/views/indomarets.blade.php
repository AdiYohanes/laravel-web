<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
     
    <meta name="csrf-token" content="{{ csrf_token() }}">
     
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
    <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
 
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

 
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form>
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Enter name" id="userName">
                                </div>
                                <div class="col-sm-4">
                                    <input type="email" class="form-control" placeholder="Enter email" id="userEmail">
                                </div>
                                <div class="col-sm-2" id="saveBtn">
                                    <button type="button" class="btn btn-primary btn-block" onclick="add()" >Save</button>
                                </div>
                                <div class="col-sm-2" id="updateBtn">
                                    <button type="button" class="btn btn-success btn-block" onclick="update()" >Update</button>
                                </div>
                                <div class="col-sm-2" id="cancelBtn">
                                    <button type="button" class="btn btn-danger btn-block" onclick="cancel()" >Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container mt-2">
 
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 
    <div class="card-body">
 
        <table class="table table-bordered" id="ajax-crud-datatable">
           <thead>
              <tr>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Action</th>
              </tr>
           </thead>
        </table>
 
    </div>
    
</div>
 
 
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script >
    const saveBtn = $('#saveBtn');
    const updateBtn = $('#updateBtn');
    const cancelBtn = $('#cancelBtn');
    let globalUserId = '';
    $(document).ready(function () {
        $('#userName').focus()
        viewData();
    });

 function viewData() {
        saveBtn.show();
        updateBtn.hide();
        cancelBtn.hide();
        
        $('#userName').attr('disabled', false)
        $('#userName').val('');
        $('#userEmail').val('');

  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    $('#ajax-crud-datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url('ajax-crud-datatable') }}",
           columns: [
                    { data: 'userName', name: 'userName' },
                    { data: 'userEmail', name: 'userEmail' },
                    {data: 'action', name: 'action', orderable: false},
                 ],
                 order: [[0, 'desc']]
       });
 
  };
   
  function add(){
    const userName = $('#userName').val();
        const userEmail = $('#userEmail').val();
        const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if(userName.length < 1 || userEmail.length < 1) {
            swal("Warning", "Form can't be empty", 'info');
            $('#userName').focus();
            return false;
        } else if (!userEmail.match(validRegex)){
            swal("Warning", "Invalid email address", 'info');
            $('#userEmail').focus();
            return false;
        }

        $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
        $.ajax({
            url: "{{ url('store-company') }}",
            method: 'post',
            data: {userName, userEmail},
            success: function (result) {
                if(result.status == 200){
                    swal("Success", result.message, 'success')
                } else {
                    swal("Something's wrong!", result.message, 'warning')
                }
                $('#userName').focus()

            }, error: function (error) {
                console.log(error);
            }
        })
      
 
  }   
  function editFunc(id){
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    $.ajax({
        type:"POST",
        url: "{{ url('edit-company') }}",
        data: { id },
        dataType: 'json',
        success: function(result){
                    saveBtn.hide();
                    updateBtn.show();
                    cancelBtn.show();

                    $('#userName').attr('disabled', true)
                    $('#userName').val(result.data[0].name);
                    $('#userEmail').val(result.data[0].email);
                    globalUserId = result.data[0].id;
  
            }, error: function (error) {
                console.log(error);
            }
        })
    }

    function update(){
        const userId = globalUserId
        const userEmail = $('#userEmail').val();
        const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (!userEmail.match(validRegex)){
            swal("Warning", "Invalid email address", 'info');
            $('#userEmail').focus();
            return false;
        }

        swal("Are You Sure Want to Update Data?", {
            icon: 'warning',
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: 'bg-danger text-white',
                    closeModal: true,
                },
                confirm: {
                    text: "Delete",
                    value: "confirm",
                    visible: true,
                    className: "",
                }
            },
        }).then((value) => {
            switch (value) {
                case "confirm":
                $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
                    $.ajax({
                        url: "{{ url('store-company') }}",
                        method: 'post',
                        data: {userId, userEmail},
                        beforeSend: function () {},
                        success: function (result) {
                            if(result.status == 200){
                                swal("Success", result.message, 'success')
                            } else {
                                swal("Something's wrong!", result.message, 'warning')
                            }
                            viewData();
                        }, error: function (error) {
                            console.log(error);
                        }
                    });
                    break;
                default:
                    console.log("Cancel!");
            }
        });
    }
    function cancel(){
        viewData();
    }


 
  function deleteFunc(id){
        if (confirm("Delete Record?") == true) {
        var id = id;
          
          // ajax
          $.ajax({
              type:"POST",
              url: "{{ url('delete-company') }}",
              data: { id: id },
              dataType: 'json',
              success: function(res){
 
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
             }
          });
       }
  }
 

</script>
</html>