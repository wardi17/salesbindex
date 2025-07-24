
  <div id="main">
<div class ="col-md-12 col-12">
        <div class="card"  style="width:80%">
            <div class="card-content">
            <div class="card-body">
            <div  class="page-heading mb-3">
                  <div class="page-title">
                  <h4 class="text-center">Master Jadwal</h4>
                  </div>
                </div>
                    <div class="col-md-12 text-end mb-3">
                        <button type="button" class="btn btn-lg " id="tambahjdw" data-bs-toggle="modal" data-bs-target="#TambaModal_jadwal">
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
    
      const obj = new ms_jadwal();


      const url ="<?=base_url?>";

      obj.get_tampildata(url);
   

      $("#tambahjdw").on("click",function (even) {
        even.preventDefault();
        const url ="<?=base_url?>";
         let userpetugas= obj.getnamaPetugas(url);

        })
    });// batas documenreadiy


    function goBack(){
        window.location.replace("<?= base_url; ?>/masterjadwal/index");
    }
</script>