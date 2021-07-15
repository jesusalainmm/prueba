    <div class="modal" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"  style="text-align: right;" >                    
                    <h3 class="modal-title text-center" id="myModalLabel"> Actualizar nuevo empleado </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div><!-- class="modal-header"  -->
                <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;" >  
                <form action="{{ route('home.update', $id) }}" id="form_edit" onsubmit="return false;">
                @csrf
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Nombre completo." required maxlength="120" value="{{ $empleado->nombre }}" >
                            <small id="nombreHelp" class="form-text text-muted"></small>
                            </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email." required  value="{{ $empleado->email }}">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="M" aria-describedby="sexo1Help" required
                                @if($empleado->sexo == 'M')
                                    checked="checked"
                                @endif                                
                                >
                                <label class="form-check-label" for="exampleRadios1">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="F" aria-describedby="sexo2Help" required
                                @if($empleado->sexo == 'F')
                                    checked="checked"
                                @endif                                
                                >
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
                                    <option value="{{ $area->id }}"
                                    @if($area->id == $empleado->area_id)
                                    selected=""
                                    @endif
                                    >{{ $area->nombre }}</option>
                                @endforeach
                                @endif
                            </select>
                            <small id="area_idHelp" class="form-text text-muted"></small>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" aria-describedby="descripcionHelp" placeholder="Descripcion." required rows="3" >{{ $empleado->descripcion }}</textarea>
                            <small id="descripcionHelp" class="form-text text-muted"></small>
                        </div><!-- /.form-group -->      
                    </div><!-- /.col-md-12 -->      

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rol_id">Roles</label>
                                @if($roles)
                                @foreach($roles AS $rol)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $rol->id }}" id="rol_id{{ $rol->id }}" name="rol_id[]" aria-describedby="rol_id{{ $rol->id }}Help" required
                                    @php
                                        foreach($empleado_rol As $role){
                                            if($role->rol_id == $rol->id){
                                                echo ' checked="checked" ';
                                            }
                                        }
                                    @endphp
                                    >
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
                                <input class="form-check-input" type="checkbox" value="1" id="boletin" name="boletin" aria-describedby="boletinHelp" 
                                @if($empleado->boletin == 1)
                                    checked="checked"
                                @endif                                
                                >
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
                    <button type="button" class="btn btn-primary" onclick="edit();" id="btn_edit" >
                        <i class="fas fa-plus-circle"></i> Actualizar
                    </button>
                </div>
            </div><!--  class="modal-content" -->
        </div><!--  class="modal-dialog modal-lg modal-dialog-centered" -->
    </div><!-- class="modal fade"  --> 