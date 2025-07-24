
  <!-- Modal  tambah baru  member divisi-->
  <div class="modal fade" id="TambaModal" tabindex="-1" aria-labelledby="TambaModalLabel" aria-hidden="true">
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
                                <label for="jenislimbah" class="col-sm-2 form-label">Jenis Limbah</label>
                               <div class="col-sm-6">
                                <input id="jenislimbah"  maxlength="100" name="jenislimbah" type="text" class="form-control">
                                </div>
                           
                </div>
      
              
          
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" id="Createdata" name="sumbit" class="btn btn-primary me-1 mb-3">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" onclick="goBack();">Batal</button>
                                  </div>
          </form>
      </div>
    </div>
  </div>
  </div>

<script>
    $(document).ready(function(){
      const obj = new ms_limbah();
      
        $("#Createdata").on("click",function(e){
            e.preventDefault();
            const jenislimbah = $("#jenislimbah").val();
           
           const url ="<?=base_url?>";
            const datas ={
                "jenislimbah" :jenislimbah,
            }

            obj.Savedata(url,datas);
            
      })
    
    }) //batas document ready
   

</script>