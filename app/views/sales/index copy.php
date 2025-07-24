<?php
date_default_timezone_set('Asia/Jakarta');
$hariIni = new DateTime();

$formathari = $hariIni->format('F Y');


?>
<style>
table {
    font-size:12px; /* Ubah ukuran teks sesuai kebutuhan */
}

#tebelatas,th,td{
  font-size:12px;
    border: 0; /* Menambahkan garis pada sel */
    padding: 8px; /* Memberikan ruang di dalam sel */
    text-align: left 
}
 th,td {
    font-size:12px;
    border: 1px solid black; /* Menambahkan garis pada sel */
    padding: 8px; /* Memberikan ruang di dalam sel */
    text-align: left /* Ubah ukuran teks header */
}
th {
            background-color: #f2f2f2; /* Warna latar belakang untuk header */
        }
        tr,td {
            height:25px; /* Ubah tinggi baris */
        }

</style>
  <div id="">
<div class ="col-md-12 col-12">
        <div class="card">
            <div class="card-content">
            <div class="card-body">
            <div  class="page-heading mb-3">
                  <div class="page-title">
                  <h6 class="text-start">Sales PT Bindex International</h6>
                 
                  <!-- <h6>Hari : <span id="harikerja"></span></h6> -->
                  </div>
                </div>
                <div class=" row col-md-12">
                    <div class="row col-md-2" style="width:20%;">  
                                <label style="width:30%;" for="selectahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-6">
                                  <select class ="form-control" id="selectahun"></select>                             
                              </div>
                      </div>  
                      <div class="row col-md-4" style="width:20%;">  
                                <label style="width:30%;"  for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-8">
                                  <select class ="form-control" id="selecbulan"></select>                                
                                </div>
                        </div>
                        <div class="col-sm-2">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Createdata">Sumbit</button>
                                  </div>
                </div>
               
                <div id="tampildata"></div>     
            </div>
                               
            </div>
            </div>
        </div>
  </div>
  <div class ="col-md-12 col-12">
     
  </div>
<script>
    $(document).ready(function(){
    
      // const obj = new ms_petugas();


      // const url ="<?=base_url?>";

      // obj.get_tampildata(url);
      get_tahun();
      get_bulan();
      settahunbulan();
     
      $("#Createdata").on("click",function(e){
        e.preventDefault()
        let tahun = $("#selectahun").find(":selected").val();
        let bulan = $("#selecbulan").find(":selected").val();

        const datas ={
          "tahun":tahun,
          "bulan":bulan
        };

        setharikerja(datas)
        //Getdata(datas);

      })
      
    }); //batas document ready jquery 2024 D war
    
        function  Getdata(datas){

          $.ajax({
              url:"<?=base_url?>/sales/Tampildata",
              method:"POST",
              cache:false,
              dataType:'json',
              success:function(responses){
                console.log(responses)
              }

          })
        }
      function setharikerja(datas){
         
        $.ajax({
              url:"<?=base_url?>/sales/getharikerja",
              method:"POST",
              data:datas,
              cache:false,
              dataType:'json',
              beforeSend :function(){    
                                Swal.fire({
                                    title: 'Loading...',
                                    html: 'Please wait...',
                                    allowEscapeKey: false,
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                    Swal.showLoading()
                                    }
                                    });
                                },
              success:function(responses){
                          Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                showConfirmButton: false,
                                timer:10
                                }).then(function(){
                                SetTabeldata(responses,datas);
                                });
                            
              }

          })

      }


     function  SetTabeldata(responses,datas){
          let th = datas.tahun;
          let bln = datas.bulan;
          let target = responses.Target;
          let target2 = responses.Target2;
          let hk = responses.Hari;
          const detaildata = responses.Detaildata;
       
          let Tabeldata =``;

           Tabeldata +=`
              <div class="col-md-12 mt-4 mb-4">
                <table id="tebelatas">
                <thed>
                  <tr>
                    <th>${th} ${bln}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thed>
                <tbody>
                  <tr>
                    <th>Target</th>
                    <th>:</th>
                    <th>&nbsp; Rp.&nbsp;${target} &nbsp;&nbsp;&nbsp; Rp.&nbsp;${target2}</th>
                  
                  </tr>
                  <tr>
                    <th>Hari</th>
                     <th>:</th>
                     <th>&nbsp; ${hk}</th>
                  </tr>
                </tbody>
                </table>
              </div>
           `;

        Tabeldata +=`
          <table id="Tabel1" styles="font-size: 8px;" class="display table-hover table-info" style='width:100%'>                    
                                                    <thead class="thead">
                                                    <tr>
                                                                <th rowspan="3" style="width:5%" class="text-center">Tgl</th>
                                                                <th rowspan="3" class="text-center">HARI</th>
                                                                <th colspan="5" class="text-center">OFLINE</th>
                                                                <th rowspan="2" class="text-center">ONLINE</th>
                                                                <th rowspan="3" class="text-center">TOTAL</th>
                                                                <th rowspan="3" class="text-center">ACCUMULATION</th>
                                                                <th rowspan="3" class="text-center">CURRENT DAY </br>TARRGETS</th>
                                                                <th rowspan="3" class="text-center">ACHIEVEMENT </br>%</th>
                                                                <th rowspan="3" class="text-center">PROJECTION</th>
                                                                <th rowspan="3" class="text-center">ACHIEVEMENT </br> %</th>
                                                                // <th rowspan="3" class="text-center">GRAN TOTAL</th>
                                                    </tr>
                                                    <tr>
                                                    <th class="text-center">CORPORATE</th>
                                                    <th class="text-center">DEALER</th>
                                                    <th class="text-center">DEPSTORE</th>
                                                    <th class="text-center">STORE</th>
                                                    <th class="text-center">USER</th>
                                                    </tr>
                                                      <tr>
                                                      <th class="text-center">Harian</th>
                                                      <th class="text-center">Harian</th>
                                                      <th class="text-center">Harian</th>
                                                      <th class="text-center">Harian</th>
                                                      <th class="text-center">Harian</th>
                                                      <th class="text-center">Harian</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
        `;

      console.log(responses.w1);
      $.each(detaildata,function(a,b){
        
          Tabeldata +=`
              <tr>
              <td class="text-center">${b.Tgl}</td>
              <td class="text-center">${b.Hari}</td>
              <td class="text-end">Rp. ${b.Corporate}</td>
              <td class="text-end">Rp. ${b.Dealer}</td>
              <td class="text-end">Rp. ${b.Depstore}</td>
              <td class="text-end">Rp. ${b.Store}</td>
              <td class="text-end">Rp. ${b.Users}</td>
              <td class="text-end">Rp. ${b.Online}</td>

              <td class="text-end">Rp. ${b.Total}</td>
              <td class="text-end">Rp. ${b.Accumulation}</td>
              <td class="text-end">Rp. ${b.Current_day_targets}</td>
              <td class="text-end">${b.Achivement1}%</td>
              <td class="text-end">${b.Projection}</td>
              <td class="text-end">${b.Achivement2}%</td>

              // <td id="gr_total"></td>
              </tr>
          `;

       
      })
    Tabeldata +=`</tbody>`;
    Tabeldata +=`<tfoot>`;
    Tabeldata +=`
              <tr>
              <th colspan="2">TOTAL</th>
              <th>${responses.totalCorporate}</th>
              <th>${responses.totalDealer}</th>
              <th>${responses.totalDepstore}</th>
              <th>${responses.totalStore}</th>
              <th>${responses.totalUsers}</th>
              <th>${responses.totalOnline}</th>
              <th></th>

              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              </tr>
          `;
    Tabeldata +=`
              <tr>
              <th colspan="2">TARGET</th>
              <th>${responses.TargetCorporate}</th>
              <th>${responses.TargetDealer}</th>
              <th>${responses.TargetDepstore}</th>
              <th>${responses.TargetStore}</th>
              <th>${responses.TargetUsers}</th>
              <th>${responses.TargetOnline}</th>
              <th></th>

              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              </tr>
          `;
   Tabeldata +=`
              <tr>
              <th colspan="2">KEKURANGAN TARGET</th>
              <th>${responses.krg_cor}</th>
              <th>${responses.krg_der}</th>
              <th>${responses.krg_dep}</th>
              <th>${responses.krg_sto}</th>
              <th>${responses.krg_use}</th>
              <th>${responses.krg_onl}</th>
              <th></th>

              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              </tr>
          `;
    Tabeldata +=`
              <tr>
              <th colspan="2">% Prediksi Pencapaian sd Akhir Bln</th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>

              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              </tr>
          `;
    Tabeldata +=`
              <tr>
              <th colspan="2">Garand Total</th>
              <th colspan="6" class="text-center">${responses.garand_total}</th>
              <th></th>

              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              </tr>
          `;
    Tabeldata +=`
              <tr>
              <th colspan="2">Total Target</th>
              <th colspan="6" class="text-center">${responses.total_target}</th>

              
              <th></th>

              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              </tr>
          `;
    Tabeldata +=`</tfoot>`; 
      Tabeldata +=`</table>`;

           $("#tampildata").empty().html(Tabeldata);
           //datatale12();


  //setrowspandata();
}

    function setrowspandata(){
      $("#gr_total").attr('rowspan',3).nextAll().remove();
      $('#Tabel1 tr:nth-child(2) td:first-child').remove();
      $('#Tabel1 tr:nth-child(3) td:first-child').remove();
    }
     function datatale12(){
        
        $("#Tabel1").DataTable({
                         autoWidth: false,
                         responsive: true,
                           "ordering": true,
                           "destroy":true,
                           // dom: 'Plfrtip',
                           //     scrollCollapse: true,
                           paging:true,
                           //     "bPaginate":false,
                           //     "bLengthChange": false,
                           //     "bFilter": true,
                           //     "bInfo": false,
                           //     "bAutoWidth": false,
                           //     dom: 'lrt',
                               fixedColumns:   {
                               // left: 1,
                                   right: 1
                               },
                               pageLength: 10,
                               lengthMenu: [[10, 20, -1], [10, 20, 'All']],
                      'rowCallback': function(row, data, index){
                        

                          let hari = $(row).find('td:eq(1)').text();
                         

                          if(hari =="Sabtu" || hari =="Minggu" ){
                            $(row).find('td:eq(0)').css('color', 'red');
                            $(row).find('td:eq(1)').css('color', 'red');
                          }
                      },
                     /*"footerCallback": function ( row, data, start, end, display ) {
                             let api = this.api();
                 
                         // Remove the formatting to get integer data for summation
                         let intVal = function (i) {
                             const w = i;
                             return typeof w === 'string'
                                 ? w.replace(/[\$,]/g, '') * 1
                                 : typeof w === 'number'
                                 ? w
                                 : 0;
                         };
                 
                         // Total over all budget
                         total_budget = api
                             .column(2)
                             .data()
                             .reduce((a, b) =>intVal(a) + intVal(b), 0).toLocaleString();
                          // Total over all realisasi
                        total_realisasi = api
                             .column(3)
                             .data()
                             .reduce((a, b) =>intVal(a) + intVal(b), 0).toLocaleString();



                          // Total over all realisasi
                        total_sisa = api
                             .column(4)
                             .data()
                             .reduce((a, b) =>intVal(a) + intVal(b), 0).toLocaleString();      
                         // Total over this page
                         pageTotal = api
                             .column(2, { page: 'current' })
                             .data()
                             .reduce((a, b) => intVal(a) + intVal(b), 0).toLocaleString();
                 
                         // Update footer
                         api.column(2).footer().innerHTML =
                         total_budget; 
                         api.column(3).footer().innerHTML =
                         total_realisasi; 
                         api.column(4).footer().innerHTML =
                         total_sisa;          
                        },*/
                   
                       });
   
   
   
   
 }


      function settahunbulan(){
        const dateya = new Date();
        let bulandefault = dateya.getMonth()+1;
        let tahundefault = dateya.getFullYear();
        let tahun = tahundefault;

 
        $("#selectahun").val(tahun);
        let bln = bulan_angka(bulandefault);
   
        $("#selecbulan").val(bln);
      }
      function get_tahun(){
        
        let startyear = 2020;
        let date = new Date().getFullYear();
        
        let endyear = date + 2;
        
        for(let i = startyear; i <=endyear; i++){
          let selected = (i !== date) ? 'selected' : date; 
          $("#selectahun").append($(`<option />`).val(i).html(i).prop('selected', selected));

        }
    }

    function get_bulan(){
      let seletBulan = $("#selecbulan");
      const namaBulan = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ];
    
      for(let a = 0 ; a < namaBulan.length; a++){
        let option = $('<option>',{
          value: namaBulan[a] ,
          text: namaBulan[a]
        });
        seletBulan.append(option);
      }
    } 

    function bulan_angka(angkaBulan){
        const namaBulan2 = [
          "January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];

        // Pastikan angkaBulan berada dalam rentang 1 hingga 12
        if (angkaBulan >= 1 && angkaBulan <= 12) {
          return namaBulan2[angkaBulan - 1];
        } else {
          return "Bulan tidak valid";
        }

    }
    function goBack(){
       // window.location.replace("<?= base_url; ?>/masterPetugas/index");
    }
</script>