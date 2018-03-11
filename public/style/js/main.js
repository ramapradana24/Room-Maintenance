$(document).ready(function(){

    //sidebar
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    //data tables
     $('#tableJadwal').DataTable();
     $('#tablePengaduan').DataTable();

     //tooltip
     $('[data-toggle="tooltip"]').tooltip();

     $('.btn-edit-jadwal').click(function(){
     	var iTr = $('.btn-edit-jadwal').index(this);
     	var row = $('#tableJadwal tbody tr').eq(iTr);
     	var noKamar = row.find('td').eq(1).html();
     	var namaPegawai = row.find('td').eq(2).html();
     	var tglPengecekan = row.find('td').eq(3).html();

     	//mengubah select pada modal edit jadwal
     	$("#sl-no-kamar option").each(function(){
     		if($(this).html() == noKamar){
     			var valOption = $(this).val();
     			$("#sl-no-kamar").val(valOption);
     		}
     	});

     	$("#sl-nama-pegawai option").each(function(){
     		if($(this).html() == namaPegawai){
     			var valOption = $(this).val();
     			$("#sl-nama-pegawai").val(valOption);
     		}
     	});

     	console.log(tglPengecekan);
     	$("#input-tgl-pengecekan").val(tglPengecekan);

     });


     //dinamik jumlah tgl pengecekan
     $('#jml-tgl').on("change", function(){
     	var jumlah = $(this).val();
     	$("#daftar-tgl").html("");
     	for(var i = 0; i < jumlah; i++){
     		$("#daftar-tgl").append('<input type="date" class="form-control" name="tgl'+(i+1)+'">');
     	}
     });

     //reset checkbox kamar
     $("#reset-check-box").click(function(){
     	console.log("ok");
     	$(".cuz-cb").each(function(){
     		if($(this).is(':disabled') == false){
     			$(this).prop("checked", false);
     		}
     	});
     });

     //centang semua checkbox kamar
     $("#semua-check-box").click(function(){
     	console.log("ok");
     	$(".cuz-cb").each(function(){
     		if($(this).is(':disabled') == false){
     			$(this).prop("checked", true);
     		}
     	});
     });

});