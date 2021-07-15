@extends('layouts.app')

@section('content')

<div class="row" >            
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">            
        <div class="card">
            <div class="card-header">
                <h5>Listado
                    <button class="btn btn-primary float-right" onclick="modal_create('{{ route('home.create') }}');" >Agregar <i class="fa fa-plus-square"></i></button>
                </h5>
                
            </div>
            <div class="card-body table-responsive no-padding">                                                    
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" >
                    <thead>
                        <tr>
                            <th><i class="fa fa-user"></i> Nombre</th>
                            <th><i class="fa fa-envelope"></i> Email</th>
                            <th><i class="fa fa-venus-mars"></i> Sexo</th>
                            <th><i class="fa fa-warehouse"></i> Area</th>
                            <th><i class="fa fa-box"></i> Boletin</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($empleados)
                        @foreach ($empleados as $row)
                        <tr>
                            <td>{{ $row->nombre }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ ($row->sexo == 'F')? 'Femenino' : 'Masculino' }}</td>
                            <td>{{ $row->area }}</td>
                            <td>{{ ($row->boletin == 1)? 'Si' : 'No' }}</td>
                            <td>
                                <div class="text-center">
                                    <a href="javascript:modal_edit('{{ route('home.edit', $row->id) }}');" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar">
                                        <i class="fa fa-edit m-0"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <a href="javascript:modal_delete('{{ route('home.edit', $row->id) }}');" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar">
                                        <i class="fa fa-trash m-0"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div><!-- class="card-body table-responsive no-padding" -->
        </div><!-- class="card" -->                
    </div><!-- ./col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 -->                
</div><!-- ./row -->            
<div id="response"></div>
@endsection

@section('script')
<script>
    
function modal_create(url) {
    $.ajax({                        
        url: url,                    
        type: 'GET',
        beforeSend: function (){
        },
        success: function(response)  
        {
            $("#response").html(response);
            $("#modal_create").modal("show");
        },
        error: function (jqXHR, exception) {
            ajaxError(jqXHR, exception);
        }
    }); 
}

function create() {
    asyncCallForm('form_create').then(valid => {            
        if(valid){
            $( "input[type=checkbox]" ).each(function(){
                if (this.checked) {
                    valid = false;
                }
            }); 
            if(!valid){
            var form            = $("#form_create");
            var url             = form.attr("action");	
            
            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function (){
                    $("#btn_create").attr("disabled", true);
                },
                success: function(response)  
                {
                    if(parseInt(response.accion) == 1){
                        alertify.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }else{
                        alertify.error(response.message);
                        $("#btn_create").attr("disabled", false);
                    }
                },
                error: function (jqXHR, exception) {
                    ajaxError(jqXHR, exception);                    
                    $("#btn_create").attr("disabled", false);
                }
            });
            }else{
                alertify.error('Debes seleccionar un rol');
            }
        }
    });
}

function modal_edit(url) {
    $.ajax({                        
        url: url,                    
        beforeSend: function (){
        },
        success: function(response)  
        {
            $("#response").html(response);
            $("#modal_edit").modal("show");
        },
        error: function (jqXHR, exception) {
            ajaxError(jqXHR, exception);
        }
    });
}

function edit() {
    asyncCallForm('form_edit').then(valid => {    
        if(valid){
            $( "input[type=checkbox]" ).each(function(){
                if (this.checked) {
                    valid = false;
                }
            }); 
            if(!valid){
            var form            = $("#form_edit");
            var url             = form.attr("action");	
            
            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function (){
                    $("#btn_edit").attr("disabled", true);
                },
                success: function(response)  
                {
                    if(parseInt(response.accion) == 1){
                        alertify.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }else{
                        alertify.error(response.message);
                        $("#btn_edit").attr("disabled", false);
                    }
                },
                error: function (jqXHR, exception) {
                    ajaxError(jqXHR, exception);
                    $("#btn_edit").attr("disabled", false);
                }
            });
            }else{
                alertify.error('Debes seleccionar un rol');
            }
        }
    });
}

function modal_remove(url) {
    $.ajax({                        
        url: url,                    
        type: 'POST',
        data: { id: id },
        beforeSend: function (){
        },
        success: function(response)  
        {
            $("#response").html(response);
            $("#modal_remove").modal("show");
        },
        error: function (jqXHR, exception) {
            ajaxError(jqXHR, exception);
        }
    });
}



function validateForm(form) {
    return new Promise(resolve => {
        var errores    = 0;         
        $("#"+form).find(':required').each(function() {
            var elemento   = this;
            if (elemento.value.length > 0){
                $(this).removeClass("is-invalid"); 
                $('#'+elemento.id+'Help').removeClass('text-danger');
                $('#'+elemento.id+'Help').addClass('text-muted');
                $('#'+elemento.id+'Help').html('');            
            }else{
                var campo = $('label[for="'+this.id+'"]').text();
                $(this).addClass("is-invalid");
                $('#'+elemento.id+'Help').removeClass('text-muted');
                $('#'+elemento.id+'Help').addClass('text-danger');
                alertify.error('El campo '+campo+' es requerido.'); 
                $('#'+elemento.id+'Help').html('El campo '+campo+' es requerido.');
                errores++;
            }         
        });
        resolve(errores);
    });
}

async function asyncCallForm(form) {
    const result = await validateForm(form);
    if (result > 0){
        return false;
    }else{
        return true;
    }
}



function ajaxError(jqXHR, exception) {
    var msg = '';
    if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
    } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
    } else if (exception === 'parsererror') {
        msg = 'No se puede eliminar el registro.';
    } else if (exception === 'timeout') {
        msg = 'Time out error.';
    } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
    } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
    }
    alertify.error(msg);
    console.log(msg);
}

</script>
@endsection
