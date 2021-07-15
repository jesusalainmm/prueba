    <div class="modal" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"  style="text-align: right;" >                    
                    <h3 class="modal-title text-center" id="myModalLabel"> Ingresar nuevo empleado </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div><!-- class="modal-header"  -->
                <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;" >  
                <form action="{{ route('home.store') }}" id="form_create" onsubmit="return false;">
                @csrf
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Nombre completo." required maxlength="120" >
                            <small id="nombreHelp" class="form-text text-muted"></small>
                            </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email." required>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="M" checked aria-describedby="sexo1Help" required>
                                <label class="form-check-label" for="exampleRadios1">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="F" aria-describedby="sexo2Help" required>
                                <label class="form-check-label" for="exampleRadios2">
                                    Femenino
                                </label>
                            </div>                                
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="area_id">Area</label>
                            <select class="form-control" id="area_id" name="area_id" aria-describedby="area_idHelp" required>
                                <option value=""></option>
                                @if($areas)
                                @foreach($areas AS $area)
                                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                @endforeach
                                @endif
                            </select>
                            <small id="area_idHelp" class="form-text text-muted"></small>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" aria-describedby="descripcionHelp" placeholder="Descripcion." required rows="3" ></textarea>
                            <small id="descripcionHelp" class="form-text text-muted"></small>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rol_id">Roles</label>
                                @if($roles)
                                @foreach($roles AS $rol)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $rol->id }}" id="rol_id{{ $rol->id }}" name="rol_id[]" aria-describedby="rol_id{{ $rol->id }}Help" required>
                                    <label class="form-check-label" for="rol_id{{ $rol->id }}">{{ $rol->nombre }}</label>
                                </div>
                                @endforeach
                                @endif
                            <small id="rol_idHelp" class="form-text text-muted"></small>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="boletin" name="boletin" aria-describedby="boletinHelp" >
                                <label class="form-check-label" for="boletin">Deseo recibir boletin informativo</label>
                            </div>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                    
                </form>
                </div><!-- class="modal-body"  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fas fa-times-circle"></i> Cerrar
                    </button>                    
                    <button type="button" class="btn btn-primary" onclick="create();" id="btn_create" >
                        <i class="fas fa-plus-circle"></i> Guardar
                    </button>
                </div>
            </div><!--  class="modal-content" -->
        </div><!--  class="modal-dialog modal-lg modal-dialog-centered" -->
    </div><!-- class="modal fade"  --> 