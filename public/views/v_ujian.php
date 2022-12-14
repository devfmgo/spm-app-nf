<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard - <?php echo $this->config->item('nama_aplikasi')." ".$this->config->item('versi'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- <link href="<?php echo base_url(); ?>___/css/bootstrap.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">
<style>
.not-active {
   pointer-events: none;
   cursor: default;
}
</style>
</head>
<body>

<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><i class="fa fa-home"></i> <?php echo $this->config->item('nama_aplikasi')." ".$this->config->item('versi'); ?></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->session->userdata('admin_nama')." (".$this->session->userdata('admin_user').")"; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" onclick="return rubah_password();">Ubah Password</a></li>
                        <li><a href="<?php echo base_url(); ?>adm/logout" onclick="return confirm('keluar..?');">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container col-md-12" style="margin-top: 70px">
    <div class="col-md-9">
        <form role="form" name="_form" method="post" id="_form">
            <div class="panel panel-default">
                <div class="panel-heading">Soal Ke <div class="btn btn-info" id="soalke"></div>
        
                    <div class="tbl-kanan-soal">
                        <div id="clock" style="font-weight: bold" class="btn btn-danger"></div>
                    </div>
                </div>

                <div class="panel-body">
                <?php echo $html; ?>
                </div>

                <div class="panel-footer">
                    <a class="action back btn btn-info btn-lg" rel="0" onclick="return back();"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <a class="action next btn btn-info btn-lg" rel="2" onclick="return next();"><i class="glyphicon glyphicon-chevron-right"></i> Next</a>
                    <a class="action submit btn btn-danger btn-lg pull-right" onclick="return simpan_akhir();"><i class="glyphicon glyphicon-stop"></i> Selesai Ujian</a>
                    <input type="hidden" name="jml_soal" value="<?php echo $no; ?>">
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">Navigasi Soal</div>
            <div class="panel-body">
                <div id="tampil_jawaban"></div>
            </div>
        </div>
        
        <div class="panel panel-info">
        <div class="panel-heading">Mata Pelajaran</div>
        <div class="panel-body">

            <!-- <div id="tampil_jawaban"></div> -->
            <?php 
            include('config.php');
           error_reporting(0);
            // Get Pag
            $sql    = mysqli_query($con,"SELECT * FROM tr_guru_tes");
            $user   = mysqli_query($con,"SELECT * FROM m_admin WHERE username='$sess_user' ");
            foreach ($user as $u) {
                $id_user= $u['kon_id'];
            }
            
            foreach ($sql as $val) {
            $page   = $_SERVER['REQUEST_URI'];
            $ex     = explode('/',$page);
            $d      = $ex['5'];
            $id     = $val['id'];
            $status = mysqli_query($con,"SELECT * FROM tr_ikut_ujian WHERE id_tes='$id' AND id_user='$id_user'");
            foreach ($status as $key) {
                $s = $key['status'];

                if ($s=='N') {
                    $cek ="<i class='glyphicon glyphicon-ok' style='color:green;'></i>&nbsp;Selesai";
                }else{
                   $cek="<i class='glyphicon glyphicon-remove' style='color:red;'></i>&nbsp;Belum";
                }
            }
            if($d == $id){ ?>
                <a href="<?php echo base_url(); ?>adm/ikut_ujian/token/<?php echo $val['id'];?>" class="btn btn-success not-active" style="margin-bottom:4px;"><blink><i class="glyphicon glyphicon-pencil"></i>&nbsp;<?php echo $val['nama_ujian'];?></blink></a>
                <?php
                 echo $cek;
               ?>
                <br>
            <?php }else{ ?>
                <a href="<?php echo base_url(); ?>adm/ikut_ujian/token/<?php echo $val['id'];?>" class="" style="margin-bottom:4px;"><?php echo $val['nama_ujian'];?></a>
                <!-- Status Ujian -->
                <?php  echo $cek; ?>
                
                <br>
            <?php } ?>
           
            <?php } ?>
            
        </div>
    </div>
</div>

</div>
  
<div class="col-md-12" style="border-top: solid 4px #ddd; text-align: center; padding-top: 10px; margin-top: 50px; margin-bottom: 20px">
    &copy; 2017 <a href="<?php echo base_url(); ?>adm"><?php echo $this->config->item('nama_aplikasi')." ".$this->config->item('versi')."</a> <br> Waktu Server: ".tjs(date('Y-m-d H:i:s'),"s")." - Waktu Database: ".tjs($this->waktu_sql,"s"); ?>. 
</div>

<!-- 
<script src="<?php echo base_url(); ?>___/js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo base_url(); ?>___/js/bootstrap.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js" integrity="sha512-ju6u+4bPX50JQmgU97YOGAXmRMrD9as4LE05PdC3qycsGQmjGlfm041azyB1VfCXpkpt1i9gqXCT6XuxhBJtKg==" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="<?php echo base_url(); ?>___/plugin/countdown/jquery.plugin.min.js"></script> 
<script src="<?php echo base_url(); ?>___/plugin/countdown/jquery.countdown.min.js"></script> 
<!-- <script src="<?php echo base_url(); ?>___/plugin/jquery_zoom/jquery.zoom.min.js"></script>  -->

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    id_tes = "<?php echo $id_tes; ?>";

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
        return indexed_array;
    }
    
    $(document).on("ready", function(){
        $('.gambar').each(function(){
            var url = $(this).attr("src");
            // $(this).zoom({url: url});
        });
            
        hitung();
    	simpan();
        buka(1);

        widget      = $(".step");
        btnnext     = $(".next");
        btnback     = $(".back"); 
        btnsubmit   = $(".submit");

        $(".step").hide();
        $(".back").hide();
        $("#widget_1").show();
    });
      
    widget      = $(".step");
    total_widget = widget.length;
    
    hitung = function() {
        <?php 
		
	
		$mulai_test=strtotime($mulai_test);
		$batas_waktu=$waktu;
		
		//sekarang
		$jam_sekarang=date('Y-m-d H:i:s');
		$tgl_sekarang=strtotime($jam_sekarang);

		//selesai
		$tgl_selesai = $jam_selesai;
		$tgl_selesai = strtotime($tgl_selesai);

		//durasi antara  sekarang dan mulai
		$diff_skr   = $tgl_sekarang - $mulai_test;
		$jam_skr    = floor($diff_skr / (60 * 60));
		$menit_skr  = $diff_skr - $jam_skr * (60 * 60);		
		$durasi_skr = floor( $menit_skr / 60 );
		$durasi     = $batas_waktu - $durasi_skr;

		
		$tgl_mulai_baru = strtotime("+".$durasi." minutes", $tgl_sekarang);
		$tgl_baru = date('F j, Y H:i:s', $tgl_mulai_baru);
        
        ?>
        
        var waktu_selesai = new Date('<?php echo $tgl_baru; ?>');

        $('div#clock').countdown(
            {   
                until: waktu_selesai, 
                serverSync: dari_server,
                alwaysExpire: true, 
                format: 'HMS', 
                compact: true, 
                onExpiry: selesai
            }
        );
    }

    selesai = function() {
        alert('Waktu telah selesai....!')
        var f_asal  = $("#_form");
        var form  = getFormData(f_asal);
        simpan_akhir(id_tes);
        window.location.assign("<?php echo base_url(); ?>adm/sudah_selesai_ujian/"+id_tes); 
        return false;
    }

    next = function() {
        var berikutnya  = $(".next").attr('rel');
        berikutnya = parseInt(berikutnya);
        berikutnya = berikutnya > total_widget ? total_widget : berikutnya;

        $("#soalke").html(berikutnya);

        $(".next").attr('rel', (berikutnya+1));
        $(".back").attr('rel', (berikutnya-1));
        
        var sudah_akhir = berikutnya == total_widget ? 1 : 0;

        $(".step").hide();
        $("#widget_"+berikutnya).show();

        if (sudah_akhir == 1) {
            $(".back").show();
            $(".next").hide();
        } else if (sudah_akhir == 0) {
            $(".next").show();
            $(".back").show();
        }

        simpan();
    }
    
    dari_server = function() { 
        var time = null; 
        $.ajax({url: base_url+'adm/get_servertime', 
            async: false, 
            dataType: 'text', 
            success: function(text) { 
                time = new Date(text); 
            }, 
            error: function(http, message, exc) { 
                time = new Date(); 
            }
        }); 
        return time; 
    }

    back = function() {
        var back  = $(".back").attr('rel');
        back = parseInt(back);
        back = back < 1 ? 1 : back;

        $("#soalke").html(back);
        
        $(".back").attr('rel', (back-1));
        $(".next").attr('rel', (back+1));
        
        $(".step").hide();
        $("#widget_"+back).show();

        var sudah_awal = back == 1 ? 1 : 0;
         
        $(".step").hide();
        $("#widget_"+back).show();
        
        if (sudah_awal == 1) {
            $(".back").hide();
            $(".next").show();
        } else if (sudah_awal == 0) {
            $(".next").show();
            $(".back").show();
        }

        simpan();
    }

    buka = function(id_widget) {
        $(".next").attr('rel', (id_widget+1));
        $(".back").attr('rel', (id_widget-1));

        $("#soalke").html(id_widget);
        
        $(".step").hide();
        $("#widget_"+id_widget).show();
    }

    simpan = function() {
        var f_asal  = $("#_form");
        var form  = getFormData(f_asal);

        $.ajax({    
            type: "POST",
            url: base_url+"adm/ikut_ujian/simpan_satu/"+id_tes,
            data: JSON.stringify(form),
            dataType: 'json',
            contentType: 'application/json; charset=utf-8'
        }).done(function(response) {
          	var hasil_jawaban = "";
            var panjang       = response.data.length;

            for (var i = 0; i < panjang; i++) {
                if (response.data[i] != "") {
                    hasil_jawaban += '<a class="btn btn-success btn_soal btn-sm" onclick="return buka('+(i+1)+');">'+(i+1)+". "+response.data[i]+"</a>";
                } else {
                    hasil_jawaban += '<a class="btn btn-warning btn_soal btn-sm" onclick="return buka('+(i+1)+');">'+(i+1)+". -</a>";
                }
            }

            $("#tampil_jawaban").html(hasil_jawaban);
        });
        return false;
    }

    simpan_akhir = function() {
        // if (confirm('Anda yakin akan mengakhiri tes ini..?')) {
            var f_asal  = $("#_form");
            var form  = getFormData(f_asal);

            $.ajax({    
                type: "POST",
                url: base_url+"adm/ikut_ujian/simpan_akhir/"+id_tes,
                data: JSON.stringify(form),
                dataType: 'json',
                contentType: 'application/json; charset=utf-8'
            }).done(function(r) {
                if(r.status == "ok") {
                    window.location.assign("<?php echo base_url(); ?>adm/sudah_selesai_ujian/"+id_tes); 
                }
            });

          return false;
        //  }
    }

    </script> 


<?php 
/*	
		$mulai_test=strtotime($mulai_test);
		$batas_waktu=$waktu;
		
		//sekarang
		$jam_sekarang=date('Y-m-d H:i:s');
		$tgl_sekarang=strtotime($jam_sekarang);

		//selesai
		$tgl_selesai = $jam_selesai;
		$tgl_selesai = strtotime($tgl_selesai);

		//durasi antara  sekarang dan mulai
		$diff_skr  = $tgl_sekarang - $mulai_test;
		$jam_skr   = floor($diff_skr / (60 * 60));
		$menit_skr = $diff_skr - $jam_skr * (60 * 60);		
		$durasi_skr=floor( $menit_skr / 60 );
		$durasi=$batas_waktu-$durasi_skr;

		
		$tgl_mulai_baru = strtotime("+".$durasi." minutes", $tgl_sekarang);
		$tgl_baru = date('F j, Y H:i:s', $tgl_mulai_baru);

echo "MULAI TEST: ".date('F j, Y H:i:s', $mulai_test)."<br>";
echo "WAKTU TEST: ".$batas_waktu."<br>";
echo "SELESAI TEST: ".date('F j, Y H:i:s', $tgl_selesai)."<br>";
echo "IKUT TEST: ".date('F j, Y H:i:s', $tgl_sekarang)."<br>";
echo "KURANG WAKTU TEST: ".$durasi_skr."<br>";
echo "SISWA WAKTU TEST: ".$durasi."<br>";
echo "SELESAI TEST: ".$tgl_baru."<br>";

*/


?>
      
	
</body>
</html>
