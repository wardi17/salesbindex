
  <!-- Modal  tambah baru  member divisi-->
  <div class="modal fade" id="TambaModal_jadwal" tabindex="-1" aria-labelledby="TambahModal_divisiLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Master</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
            </div>
            <div class="modal-body">

      <form  id ="formtambah" class ="form form-horizontal" enctype="multipart/form-data">
      <div class="row col-md-12 mb-3">
                                <label for="tanggal" class="col-sm-2 form-label">Tanggal</label>
                               <div class="row col-sm-8">
                                <div class="col-sm-4">
                                <input id="tanggal" name="tanggal" type="date" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                <input id="jam" name="jam" type="time" class="form-control">
                                  </div>
                          
                               </div>
                </div>
        <div class="row col-md-12-col-12">
                            <div class="row col-md-12 mb-3">
                                <label for="nama" class="col-sm-2 form-label">Nama</label>
                                
                                <div class="col-md-4">
                                <select id="namapetugas" class="form-control col-md-4"></select>
                               </div>
                </div>
              
                
              
    
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" id="Createdata" name="sumbit" class="btn btn-primary me-1 mb-3">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3"  data-bs-dismiss="modal" >Batal</button>
                                  </div>
          </form>
      </div>
    </div>
  </div>
  </div>

<script>
    $(document).ready(function(){
      const d = new Date();
      // let month = d.getMonth()+1;
      // let day = d.getDate();
      // let  output = d.getFullYear()+ '/'+
      //                 (day<10 ? '0' : '') + day + '/' +
      //                 (month<10 ? '0' : '') + month 
      //                  ;

    
        let hours = d.getHours();
        let minutes = d.getMinutes();
        let seconds = d.getSeconds();
        
        // Tambahkan leading zero untuk menit dan detik
        if (minutes < 10) minutes = "0" + minutes;
        if (seconds < 10) seconds = "0" + seconds;
        
        let timeString = hours + ":" + minutes + ":" + seconds;  
        $("#jam").val(timeString);          
  
     
      const obj = new ms_jadwal();
      //getFormattedDate()
        $("#Createdata").on("click",function(e){
            e.preventDefault();
            const nama = $("#namapetugas").find(":selected").text();
            const id = $("#namapetugas").find(":selected").val();
            const tanggal = $("#tanggal").val();
            const jam = $("#jam").val();
   

         
           const url ="<?=base_url?>";
            const datas ={
                "id_petugas":id,
                "nama" :nama,
                "tanggal":tanggal,
                "jam":jam
            }
       
            
            obj.Savedata(url,datas);
            
      })
    
    }) //batas document ready
   
    function getFormattedDate() {
            const today = new Date();
            const formattedDate = today.toLocaleDateString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });

            console.log(formattedDate);
            $("#tanggal").val(formattedDate);
        }
</script>