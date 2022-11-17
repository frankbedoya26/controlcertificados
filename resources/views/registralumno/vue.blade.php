<script type="text/javascript">
  let app = new Vue({
    el: '#app',
    data: {
      alumnos: [],

      txtdni:'',
      txtape:'',
      txtnom:'',
      txtcod:'',
      txtcarr:'',
      txttel:'',
      tipo:'Cacip',
      txtdir:'',
      txtcorr:'',

      idalum:'',
      txtdnie:'',
      txtapee:'',
      txtnome:'',
      txtcode:'',
      txtcarre:'',
      txttele:'',
      txtdire:'',
      txtcorre:'',

      txtbus:''
    },
    created: function() {
      this.getalumno();
    },

    methods: {
      limpiar: function() {
      this.idalum='';
      this.txtdni='';
      this.txtape='';
      this.txtnom='';
      this.txtcod='';
      this.txtcarr='';
      this.txttel='';
      this.cbotipo='';
      this.txtdir='';
      this.txtcorr='';

      this.txtdnie='';
      this.txtapee='';
      this.txtnome='';
      this.txtcode='';
      this.txtcarre='';
      this.txttele='';
      this.cbotipoe='';
      this.txtdire='';
      this.txtcorre='';
      },
      guardar: function() {
        if (this.txtdni.trim() != "" && this.txtape.trim() != "" && this.txtnom.trim() != "" && this.txtcod.trim() != "" && this.txtcarr.trim() != "" && this.txttel.trim() != "" && this.txtdir.trim() != "" && this.txtcorr.trim() != "") {
          var data = new FormData();
          data.append('dni', this.txtdni);
          data.append('ape', this.txtape);
          data.append('nom', this.txtnom);
          data.append('cod', this.txtcod);
          data.append('carr', this.txtcarr);
          data.append('tipo', this.tipo);
          data.append('dir', this.txtdir);
          data.append('corr', this.txtcorr);
          data.append('tel', this.txttel);
          axios.post('regalumn', data).then(response => {
            if (response.data.msj == 'si') {
              toastr.success("El alumno se registró correctamente");
              this.getalumno();
              this.limpiar();
              $('#modalumno').modal('toggle');
            } else {
              toastr.warning("El alumno ya existe");
            }
          }).catch(error => {})
        } else {
          toastr.warning("Debe llenar todos los campos");
        }
      },
      getalumno: function() {
        var url = 'regalumn?bus='+this.txtbus;
        axios.get(url).then(response => {
          this.alumnos = response.data.alumno;
        })
      },
      seleccionar: function(alumno) {
        this.idalum = alumno.id;
        this.txtdnie = alumno.dni;
        this.txtapee = alumno.ape;
        this.txtnome = alumno.nom;
        this.txtcode = alumno.codigo;
        this.txtcarre = alumno.carrera;
        this.txttele = alumno.telefo;
        this.txtdire = alumno.direccon;
        this.txtcorre = alumno.correo;
        $('#modalumnoe').modal('toggle');
      },
      editar: function() {
        if (this.txtdnie.trim() != "" && this.txtapee.trim() != "" && this.txtnome.trim() != "" && this.txtcode.trim() != "" && this.txtcarre.trim() != "" && this.txttele.trim() != "" && this.txtdire.trim() != "" && this.txtcorre.trim() != "") {
          var data = new FormData();
          data.append('dni', this.txtdnie);
          data.append('ape', this.txtapee);
          data.append('nom', this.txtnome);
          data.append('cod', this.txtcode);
          data.append('carr', this.txtcarre);
          data.append('tipo', this.tipo);
          data.append('dir', this.txtdire);
          data.append('corr', this.txtcorre);
          data.append('tel', this.txttele);
          data.append('_method', 'PUT');
          var url="regalumn/"+this.idalum;
          axios.post(url, data).then(response => {
            if (response.data.msj == 'si') {
              toastr.success("El alumno se editó correctamente");
              this.getalumno();
              this.limpiar();
              $('#modalumnoe').modal('toggle');
            } else {
              toastr.warning("El alumno ya existe");
            }
          }).catch(error => {})
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