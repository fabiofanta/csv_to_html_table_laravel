<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
        <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
        <style>
            .list-group {
                background-color: #598ca2;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target= aria-controls aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
             </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="text" placeholder="Search">
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="cont">
            <div class="row">
                <div class="col-2">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            Clienti
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Utenti
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Progetti
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Canali
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Prospettive
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">KPA
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">KPI
                        </a>
                    </div>
                </div>
                <div class="col-8">
                    <h3>Drag you CSV File here</h3>
                    <form method="post" class="dropzone" action="{{ route('files.store') }}" id="dropzone-form" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                    <button type="button" class="btn btn-success pull-right" id="submit-all">Save</button>
                    <div style="margin-top:10px"class="form-group">
                    </div>
                    </form>
                    <div style="overflow-y: auto;" class="table-container">
                        <table class="table table-hover" id="mytable">
                    </div>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        Dropzone.options.dropzoneForm = {
            autoProcessQueue:false,
            init:function(){
                var submitButton = document.querySelector('#submit-all');
                myDropzone = this;

                submitButton.addEventListener("click",function(){
                    myDropzone.processQueue();
                });

                this.on("complete",function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    viewTable();
                });
            }
        };

        function viewTable() {
            axios.get('{{ route('files.index')}}')
            .then(function (response){
                console.log(response.data.success);
                var tableData = response.data.success;
                console.log(tableData[0]);
                var table = document.getElementById("mytable");
                table.removeChild(table.firstChild);
                console.log(table);
                var row = table.insertRow(0);
                for (var i = 0; i < tableData[0].length; i++) {
                    row.insertCell(i).innerHTML = tableData[0][i] ;
                }
                var row = table.insertRow(1);
                for (var i = 0; i < (tableData[1].length -1); i++) {
                    row.insertCell(i).innerHTML = tableData[1][i].trim() ;
                }
                for (var i = 2; i < (tableData.length) -1; i++) {
                    var row = table.insertRow(i);
                    for (var f = 0; f < tableData[0].length; f++) {
                        row.insertCell(f).innerHTML = tableData[i][f] ;
                    }
                }
            })
        }

    </script>
</html>
