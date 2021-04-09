<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD using AJAX</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-primary text-center">AJAX CRUD</h1>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal">NEW RECORD</button>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">New Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                                <div class="col-sm-10">
                                <input type="text"class="form-control" id="name" placeholder="anchal garg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                <input type="email"class="form-control" id="email" placeholder="email@example.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success"id="add" data-dismiss="modal">Add</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- TABLE -->
        <div class="container"> 
            <h3 class="text-center text-warning ">ALL RECORDS</h3>
        <div id="allrecords"></div>
        </div>

        <!-- edit modal  -->

        <!-- The Modal -->
        <div class="updatedata">
        <div class="modal" id="editmodal">
            <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center text-danger">UPDATE VALUES</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="name1" class="col-sm-2 col-form-label">Name:</label>
                                <div class="col-sm-10">
                                <input type="text"class="form-control" id="name1" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email1" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                <input type="email"class="form-control" id="email1">
                                </div>
                            </div>
                            <div class="form-group row">
                             <label for="password1" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="password1" >
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick = "updateRecord()" data-dismiss="modal">UPDATE</button>
                    </div>

                </div>
            </div>
        </div>
        </div>
    <script>
        $(document).ready(function(){
            readRecords();
            
            $("#add").on("click",function(){
                var name= $("#name").val();
                var email = $("#email").val();
                var password =  $("#password").val();
                //console.log(name);
                $.ajax({
                    url: 'save.php',
                    type: 'post',
                    data:{ name:name,
                            email:email,
                            password:password
                        },
                    success:function(data,status){
                        readRecords();
                       // console.log(data)
                    }
                });
            });
        });

        // read data

        function readRecords(){
                var records = "records";
                $.ajax({
                    url:'save.php',
                    type:'post',
                    data:{records:records},
                    success:function(data,status){
                            $("#allrecords").html(data);
                    }
                });
            }


            // delete record
            function deletedata(d){
                var conf =  confirm("Are you sure");
                if(conf == true){
                    $.ajax({
                        url:"save.php",
                        type:'post',
                        data:{d:d},
                        success:function(data,status){
                            readRecords();
                        }
                    });
                }
            
            }

            // edit data
            var idth;
            function editdata(e){
                idth=e;
                //alert("hello");
                $.ajax({
                    url:"save.php",
                    type:"post",
                    data:{e:e},
                    success:function(data,status){
                        var user = JSON.parse(data);
                       // console.log(user);
                       $("#name1").val(user.name);
                       $("#email1").val(user.email);
                       $("#password1").val(user.password);
                        }
                });
                $("#editmodal").modal("show");
                
            }

            // update record
            function updateRecord(){
                var name1= $("#name1").val();
                var email1 = $("#email1").val();
                var password1 =  $("#password1").val();
                //console.log(name);
                $.ajax({
                    url: 'save.php',
                    type: 'post',
                    data:{ idth:idth,
                        name1:name1,
                            email1:email1,
                            password1:password1
                        },
                    success:function(data,status){
                        $("#editmodal").modal("hide");
                        readRecords();
                       //console.log(data)
                    }
                });
            
            }
        
    </script>
</body>
</html>