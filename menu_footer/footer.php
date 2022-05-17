<!-- Footer -->
<footer class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
			<p class="text-muted"><b  style="color:#102677">  © 2022 Gestion des commandes - Application créée par </b>
			<a href="http://www.deltawebit.com/contact.php" target="_blank"><b  style="color:red">Delta Web Information Technology</b></a>
			</p>
		  </div>
		</div>
	</div>
</footer>
<!-- End Footer -->
<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/waves.min.js"></script>

<script src="plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- Peity JS -->
<script src="plugins/peity/jquery.peity.min.js"></script>
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<script src="plugins/raphael/raphael-min.js"></script>
<script src="plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js"></script>
<script src="plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="assets/pages/dashboard.js"></script>        

<!-- App js -->
<script src="assets/js/app.js"></script>
 <script src="plugins/parsleyjs/parsley.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/select2/js/select2.min.js"></script>
<script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
<script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/pages/form-advanced.js"></script>

<script src="plugins/jquery-knob/excanvas.js"></script>
<script src="plugins/jquery-knob/jquery.knob.js"></script>		

<script>
$(function () {
		setInterval(function(){
			loadRefreshNotification();
		}, 10000);
		
		function loadRefreshNotification(){
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp_Refresh_notifs=new XMLHttpRequest();
			}else{// code for IE6, IE5
			  xmlhttp_Refresh_notifs=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp_Refresh_notifs.onreadystatechange=function(){
				if (xmlhttp_Refresh_notifs.readyState==4 && xmlhttp_Refresh_notifs.status==200)
				{
					$("#idListNotifs").html(xmlhttp_Refresh_notifs.responseText);
				}
			}
			xmlhttp_Refresh_notifs.open("GET","page_ajax/ajax_refresh_notification.php",true);
			xmlhttp_Refresh_notifs.send();
		}			
});	
</script>



</body>
</html>