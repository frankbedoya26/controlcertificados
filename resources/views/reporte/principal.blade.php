<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Buscar certificados

           
        </h3>

           

           
            

    </div>
    <div class="card-body">

                                             
<form action="{{route('mostrareporte') }}" method="POST">
    @csrf
    <div class="row">
                                                <div class="form-group col-md-3 col-sm-3">
                                                <label>Desde</label>
                                            <input type="date" class="form-control" v-model="txtfecdes" name="txtfecdes">
                                            </div>
                                            <div class="form-group col-md-3 col-sm-3">
                                                <label>Hasta</label>
                                            <input type="date" class="form-control" v-model="txtfechas"
                                            name="txtfechas">
                                            </div>
                                            <div class="form-group col-md-3 col-sm-3">
                                                <label>Estado</label>
                                                <select class="form-control" v-model="cboesta" name="cboesta">
                                                    <option value="0">Todas</option>
                                                    <option value="Pendiente">Pendiente</option>
                                                    <option value="En firmas">En firmas</option>
                                                    <option value="Por entregar">Por entregar</option>
                                                    <option value="Entregado">Entregado</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-3">
                                                <label>Tipo</label>
                                                <select class="form-control" v-model="cbotipo" name="cbotipo">
                                                    <option value="0">Todas</option>
                                                    <option value="Pregrado">Pregrado</option>
                                                    <option value="Postgrado">Postgrado</option>
                                                    <option value="Cacip">Cacip</option>>
                                                </select>
              
                                            </div>

<div class="form-group">
    <button type="button" class="btn btn-info" @click="getcertificado()"><i class="fa fa-search"></i>Buscar
    </button>
    
    <button type="submit" class="btn btn-success" id="btnimp"><i class="fa fa-print"></i>Imprimir</button>
  
</div>
    



  
            
                                            
                                            
                                            </div>
</form>
 </div>
     </div>
     <div class="card card-primary" v-if="divlista">
         <div class="card-header">
             <h3 class="card-title">Lista de certificados</h3>
             
         </div>
         <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>Dni</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Fecha de ingreso</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cert in certificado">
                    <td>@{{cert.Dni}}</td>
                    <td>@{{cert.Codigo}}</td>
                    <td>@{{cert.Nombre}}</td>
                    <td>@{{cert.esta}}</td>
                    <td>@{{cert.Tipo}}</td>
                    <td>@{{cert.fecingreso}}</td>
                </tr>
            </tbody>
        </table>
        </div> 
         </div>
     </div>                                   
        
   



 


        