
  <div id="main">
<div class ="col-md-12 col-12">
        <div class="card">
            <div class="card-content">
            <div class="card-body">
            <div  class="page-heading mb-3">
                  <div class="page-title">
                  <h4 class="text-center">Master Petugas</h4>
                  </div>
                </div>
            <input type="hidden" class="form-control" id="data_id" value="<?=$kode_div?>">
                    <div class="col-md-12 text-end mb-3">
                        <button type="button" class="btn btn-lg " data-bs-toggle="modal" data-bs-target="#TambaModal_petugas">
                        <i class="fa-regular fa-file"></i>   
                    </div>
               <div id="tampildata"></div>
                               
            </div>
                               
            </div>
            </div>
        </div>
  </div>
<script>
    $(document).ready(function(){
    
      const obj = new ms_petugas();


      const url ="<?=base_url?>";

      obj.get_tampildata(url);
   
    });


    function goBack(){
        window.location.replace("<?= base_url; ?>/masterPetugas/index");
    }
</script>