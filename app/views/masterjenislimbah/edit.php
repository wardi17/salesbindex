
  <!-- Modal  tambah baru  member divisi-->
  <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Master</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
            </div>
            <div class="modal-body">

      <form  id ="formtambah" class ="form form-horizontal" enctype="multipart/form-data">
      <input id="id" name="id" type="hidden" class="form-control">

          <div class="row col-md-12-col-12">
                            <div class="row col-md-12 mb-3">
                                <label for="jenislimbah_edit" class="col-sm-2 form-label">jenislimbah</label>
                               <div class="col-sm-4">
                                <input id="jenislimbah_edit" name="jenislimbah_edit" maxlength="100" type="text" class="form-control">
                               </div>
                </div>
                
              
    
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" id="UpdateData" name="sumbit" class="btn btn-info me-1 mb-3">Update</button>
                                    <button  type="sumbit" id="DeleteData" name="sumbit" class="btn btn-danger me-1 mb-3">Delete</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal">Batal</button>
                                  </div>
          </form>
      </div>
    </div>
  </div>
  </div>

<script>
    $(document).ready(function(){
        const obj = new ms_limbah();
        $("#UpdateData").on("click",function(e){
            e.preventDefault();
            const jenislimbah = $("#jenislimbah_edit").val();
            const id = $("#id").val();

            const datas ={
                "jenislimbah" :jenislimbah,
                "id":id
            }
            const url ="<?=base_url?>";
            obj.UpdateData(url,datas);
            
      });


      $(document).on("click",".open-modal",function(){

        let id = $(this).data("id");
        let jenislimbah = $(this).data("jenislimbah");
     

        $(".modal-body #id").val(id);
        $(".modal-body #jenislimbah_edit").val(jenislimbah);
    
      })
    


      $("#DeleteData").on("click",function(e){
            e.preventDefault();
            const id = $("#id").val();
            const datas ={
                "id":id
            }

            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Hapus Data Ini!",
                type: "warning",
                showDenyButton: true,
                confirmButtonColor: "#DD6B55",
                denyButtonColor: "#757575",
                confirmButtonText: "Ya, Hapus!",
                denyButtonText: "Tidak, Batal!",
              }).then((result) =>{
                if (result.isConfirmed) {
                  const url ="<?=base_url?>";
                  obj.DeleteData(url,datas);
                }
              })
      });

    }) //batas document ready
   




</script>