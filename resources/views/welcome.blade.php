<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel Ajax Insert
                </div>

                <div class="links"> 
                    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Open Form Model</button>
                </div>
            </div>
        </div>

      
        
        {{-------------------------  MODEL Section  ------------------------------------------------}}
        
        <div id="ContactModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="contact_form">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Add Data</h4>
                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}
                            <span id="form_output"></span>
                            <div class="form-group">
                                <label>Enter First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Enter Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer"> 
        
                            <input type="hidden" name="Contact_id" id="Contact_id" value="" />
                            <input type="hidden" name="button_action" id="button_action" value="insert" />
                            <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
     

    </body>
</html>

<script>
    $(document).ready(function() { 
       $('#add_data').click(function(){
            $('#ContactModal').modal('show');
            $('#contact_form')[0].reset();
            $('#form_output').html('');
            $('#button_action').val('insert');
            $('.modal-title').text('Add / Insert Data');
            $('#action').val('Add');
       });

       $('#contact_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ route('ajaxInsert.store') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            { 
                if("abc" == "sad"){


                }
                else{
                    $('#form_output').html(data.success);
                    $('#contact_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('insert'); 
                }

                   
            }
        })
    });
});
</script>