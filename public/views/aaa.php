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
      <link href="<?php echo base_url(); ?>___/plugin/fa/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>___/plugin/datatables/dataTables.bootstrap.css" rel="stylesheet">
   </head>
   <body>

   <div class="" style="min-height: 450px">
      <nav class="navbar navbar-findcond navbar-fixed-top">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand"><a class="navbar-brand"><img src="http://nurulfikri.sch.id/wp-content/uploads/2014/10/@logo-small-e1426644583566.png" alt="" width="30" style="position:relative; top:-10px;"></a>
               <span style="position:relative; top:10px; font-weight:bold;letter-spacing: 2px;"><?php echo $this->config->item('nama_aplikasi')." ".$this->config->item('versi'); ?></span>
               </a>
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



      	<?php gen_menu(); ?>
  	<?php echo $this->load->view($p); ?>
   
   
   
   
   </div>

   <div class="col-md-12 footer">
     <a href="<?php echo base_url(); ?>adm"><?php echo $this->config->item('nama_aplikasi')." ".$this->config->item('versi')."</a><br> Waktu Server: ".tjs(date('Y-m-d H:i:s'),"s")." - Waktu Database: ".tjs($this->waktu_sql,"s"); ?>. 
   </div>

<!-- insert modal -->
<div id="tampilkan_modal"></div>


<!-- <script src="<?php echo base_url(); ?>___/js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo base_url(); ?>___/js/bootstrap.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js" integrity="sha512-ju6u+4bPX50JQmgU97YOGAXmRMrD9as4LE05PdC3qycsGQmjGlfm041azyB1VfCXpkpt1i9gqXCT6XuxhBJtKg==" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php 
if ($this->uri->segment(2) == "m_soal" && $this->uri->segment(3) == "edit") {
?>
<script src="<?php echo base_url(); ?>___/plugin/ckeditor/ckeditor.js"></script>
<?php
}
?>
<!-- editor
<script src="<?php echo base_url(); ?>___/plugin/editor/nicEdit.js"></script>
 -->

<script src="<?php echo base_url(); ?>___/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>___/plugin/datatables/dataTables.bootstrap.min.js"></script>


<script src="<?php echo base_url(); ?>___/plugin/countdown/jquery.plugin.min.js"></script> 
<script src="<?php echo base_url(); ?>___/plugin/countdown/jquery.countdown.min.js"></script> 
<!-- <script src="<?php echo base_url(); ?>___/plugin/jquery_zoom/jquery.zoom.min.js"></script>  -->

<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";
var editor_style = "<?php echo $this->config->item('editor_style'); ?>";
var uri_js = "<?php echo $this->config->item('uri_js'); ?>";
</script>
<script src="<?php echo base_url(); ?>___/js/aplikasi.js"></script> 


</body>
</html>
