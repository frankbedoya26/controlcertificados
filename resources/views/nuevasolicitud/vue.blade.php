<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{
      alumno:[],
      txtbuscar:'',
      txtalumen:'',
      divbuscar:true,
      divdatos:false,
      tabalumnos:false,
      verdivdatos:"no",
      tituloprin:"Nueva solicitud de certificados",


      nomcompleto:'',
      dni:'',
      programaes:'',
      codigo:'',
      tipo:'',
      txtemail:'',
      txttel:'',
      txtdir:'',

      cbotipo:0,

      mpregrado:10,
      mpostgrado:25,
      mcacip:20,

      monto:'',

      txtmonto:'',
      txtcant:'',

      txtnumreb:'',
      txtfecpag:'',

      idalumn:'',
      esta:'Pendiente',

		},
    created: function () {
        $("#btnemp").attr('disabled', true);
    },
		methods: {
      pagar:function(){
                if (this.tipo=="Pregrado"  || this.tipo=="pregrado") {
                  this.txtmonto=this.mpregrado*this.txtcant;
                }else if (this.tipo=="Posgrado" || this.tipo=="posgrado") {
                  this.txtmonto=this.mpostgrado*this.txtcant;
                }else if (this.tipo=="Cacip") {
                  this.txtmonto=this.mcacip*this.txtcant;
                }
      },
      empezar:function(){
        if (this.verdivdatos=="si") {
          this.divbuscar=false;
          this.divdatos=true;
          this.tituloprin="Solicitar certificado";
          this.versemestre(this.codigo,this.tipo);
        }else{
          this.divbuscar=true;
          this.divdatos=false;
        }
      },
      limpiar:function(){
        this.txtbuscar='';
        this.txtalumen='';
        this.verdivdatos="no";
        this.tituloprin="Nueva solicitud de certificados";
      this.nomcompleto="";
      this.dni="";
      this.programaes="";
      this.codigo="";
      this.tipo="";
      this.txtemail="";
      this.txttel="";
      this.txtdir="";

      this.cbotipo=0;

      this.monto="";

      this.txtmonto="";
      this.txtcant="";

      this.txtnumreb="";
      this.txtfecpag="";

      this.idalumn="";
      },
      seleccionar:function(alum){
        this.txtalumen=alum.Alumno+" - "+alum.NombreCompleto;
                        this.nomcompleto=alum.NombreCompleto;
                this.dni=alum.Dni;
                this.programaes=alum.Descripcion;
                this.codigo=alum.Alumno;
                this.txtemail=alum.Email;
                this.txttel=alum.Telefono;
                this.txtdir=alum.Direccion;
                this.tipo=alum.nivel;
                this.idalumn=alum.id;

        this.tabalumnos=false;
        $("#btnemp").removeAttr("disabled");
        this.verdivdatos="si";
      },
          versemestre:function (cod,tipo) {
        var url='semestres/'+cod+'/'+tipo+'/alumno';
        axios.get(url).then(response=>{
          this.txtcant=response.data.cant;

                          if (this.tipo=="Pregrado"  || this.tipo=="pregrado") {
                  this.txtmonto=this.mpregrado*this.txtcant;
                  this.monto=this.mpregrado;
                }else if (this.tipo=="Posgrado" || this.tipo=="posgrado") {
                  this.txtmonto=this.mpostgrado*this.txtcant;
                  this.monto=this.mpostgrado;
                }else if (this.tipo=="Cacip") {
                  this.txtmonto=this.mcacip*this.txtcant;
                  this.monto=this.mcacip;
                }
          
        });
    },
   		getalumno: function () {
        this.txtalumen="";
          if (this.txtbuscar.trim()!="" && this.cbotipo!=0) {
            var bus=this.txtbuscar;
            var url = 'nuevasol?bus='+bus+'&tipo='+this.cbotipo;
            axios.get(url).then(response=>{
              this.alumno= response.data.alumno;
              if(this.alumno.length==0){
                this.tabalumnos=false;
                this.txtalumen='El alumno no se encuentra registrado';
                $("#btnemp").attr('disabled', true);
                this.verdivdatos="no";
              }else if(this.alumno.length==1){
                this.tabalumnos=false;
                this.txtalumen=this.alumno[0]['Alumno']+" - "+this.alumno[0]['NombreCompleto'];
                this.nomcompleto=this.alumno[0]['NombreCompleto'];
                this.dni=this.alumno[0]['Dni'];
                this.programaes=this.alumno[0]['Descripcion'];
                this.codigo=this.alumno[0]['Alumno'];
                this.txtemail=this.alumno[0]['Email'];
                this.txttel=this.alumno[0]['Telefono'];
                this.txtdir=this.alumno[0]['Direccion'];
                this.tipo=this.alumno[0]['nivel'];
                this.idalumn=this.alumno[0]['id'];

                if (this.tipo=="Pregrado" || this.tipo=="pregrado" ) {
                  this.txtmonto=this.mpregrado*this.txtcant;
                  this.monto=this.mpregrado;
                }else if (this.tipo=="Posgrado") {
                  this.txtmonto=this.mpostgrado*this.txtcant;
                  this.monto=this.mpostgrado;
                }else if (this.tipo=="Cacip") {
                  this.txtmonto=this.mcacip*this.txtcant;
                  this.monto=this.mcacip;
                }

                $("#btnemp").removeAttr("disabled");
                this.verdivdatos="si";
              }else{
                this.tabalumnos=true;
              }
              
            });
          }else{
            toastr.warning("Ingrese un código o nombre del alumno");
          }
   			},
        enviar:function(){
        if (this.idalumn!= "" && this.txtnumreb.trim() != "" && this.txtfecpag.trim() != "" && this.txtcant>0 && this.esta!= "") {
          var data = new FormData();
          data.append('idalumn', this.idalumn);
          data.append('numreb', this.txtnumreb);
          data.append('fecpag', this.txtfecpag);
          data.append('monto', this.txtmonto);
          data.append('costo', this.monto);
          data.append('cant', this.txtcant);
          data.append('esta', this.esta);
          data.append('tipo', this.tipo);
          axios.post('nuevasol', data).then(response => {
            if (response.data.msj == 'si') {
              toastr.success("La solicitud se envió correctamente");
              this.limpiar();
                this.divbuscar=true;
                this.tabalumnos=false;
                this.divdatos=false;

            } 
          }).catch(error => {

          });
        } else {
          toastr.warning("Debe llenar todos los campos");
        }
        },
		},
	});

        function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return ((key >= 48 && key <= 57) || (key==8) || (key==35) || (key==34) || (key==46));
}
</script>