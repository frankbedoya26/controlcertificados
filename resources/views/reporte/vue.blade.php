<script type="text/javascript">
  let app = new Vue({
    el: '#app',
    data: {
      certificado: [],

      cboesta:0,
      cbotipo:0,
      txtfecdes:'',
      txtfechas:'',


divlista:false,
    },
    created: function() {
      $("#btnimp").attr('disabled', true);
    },
    methods: {
getcertificado: function() {
  if (this.txtfecdes.trim()!="" && this.txtfechas.trim()!="") {
        var url = 'report?tip=1&fecdes='+this.txtfecdes+'&fechas='+this.txtfechas;
        if(this.cboesta!=0 && this.cbotipo==0){
          url = 'report?tip=2&fecdes='+this.txtfecdes+'&fechas='+this.txtfechas+'&esta='+this.cboesta;
        }
        if(this.cbotipo!=0 && this.cboesta==0){
          url = 'report?tip=3&fecdes='+this.txtfecdes+'&fechas='+this.txtfechas+'&tipo='+this.cbotipo;
        }
        if(this.cbotipo!=0 && this.cboesta!=0){
          url = 'report?tip=4&fecdes='+this.txtfecdes+'&fechas='+this.txtfechas+'&tipo='+this.cbotipo+'&esta='+this.cboesta;
        }
        axios.get(url).then(response => {

          this.certificado = response.data.certificado; 
          if (this.certificado.length==0) {
            this.divlista=false;
            toastr.warning("No hay datos");
             $("#btnimp").attr('disabled', true);
          }else{
this.divlista=true;
$("#btnimp").removeAttr("disabled");
          }

        });
  }else{
    toastr.warning("Debe de ingresar las fechas");
  }
      },
    },
  });
</script>