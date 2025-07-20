	<!-- jQuery -->
	<script src="{{ URL::asset('/assets/js/jquery-3.7.1.min.js')}}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ URL::asset('/assets/js/bootstrap.bundle.min.js')}}"></script>

	<!-- Mobile Input -->
	<script src="{{ URL::asset('/assets/plugins/intltelinput/js/intlTelInput.js')}}"></script>

	<!-- Slimscroll JS -->
	<script src="{{ URL::asset('/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

	<!-- Datatable JS -->
	<script src="{{ URL::asset('/assets/plugins/datatables/datatables.min.js')}}"></script>

	<!-- Chart JS -->
	<script src="{{ URL::asset('/assets/plugins/apexchart/apexcharts.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/apexchart/chart-data.js')}}"></script>

	<!-- Datepicker Core JS -->
	<script src="{{ URL::asset('/assets/plugins/moment/moment.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/js/bootstrap-datetimepicker.min.js')}}"></script>

	<!-- Daterangepikcer JS -->
	<script src="{{ URL::asset('/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

	<!-- Daterangepikcer JS -->
	<script src="{{ URL::asset('/assets/js/moment.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

	<!-- Select JS -->
	<script src="{{ URL::asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
	
	@if(Route::is(['gdpr','ui-text-editor']))
	<!-- Summernote JS -->
	<script src="{{ URL::asset('/assets/plugins/summernote/summernote-lite.min.js')}}"></script>
	@endif
	@if(Route::is(['ui-counter']))
	<!-- Stickynote JS -->
	<script src="{{ URL::asset('/assets/plugins/countup/jquery.counterup.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/countup/jquery.waypoints.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/countup/jquery.missofis-countdown.js')}}"></script>
	@endif
	@if(Route::is(['ui-rangeslider']))
	<!-- Rangeslider JS -->
	<script src="{{ URL::asset('/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/ion-rangeslider/js/custom-rangeslider.js')}}"></script>
	@endif
	@if(Route::is(['ui-rating']))
	<!-- Rater JS -->
	<script src="{{ URL::asset('/assets/plugins/rater-js/index.js')}}"></script>

	<!-- Internal Ratings JS -->
	<script src="{{ URL::asset('/assets/js/ratings.js')}}"></script>
	@endif
	@if(Route::is(['chart-js']))
	<!-- Chart JS -->
	<script src="{{ URL::asset('/assets/plugins/chartjs/chart.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/chartjs/chart-data.js')}}"></script>
	@endif
	@if(Route::is(['form-fileupload']))
	<!-- Select JS -->
	<script src="{{ URL::asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/fileupload/fileupload.min.js')}}"></script>
	@endif
	@if(Route::is(['form-wizard']))
	<!-- Wizard JS -->
	<script src="{{ URL::asset('/assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/twitter-bootstrap-wizard/prettify.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/twitter-bootstrap-wizard/form-wizard.js')}}"></script>
	@endif
	@if(Route::is(['ui-toasts']))
	<!-- Toast JS -->
	<script src="{{ URL::asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/toastr/toastr.js')}}"></script>
	@endif
	@if(Route::is(['ui-lightbox']))
	<!-- Alertify JS -->
	<script src="{{ URL::asset('/assets/plugins/lightbox/glightbox.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/lightbox/lightbox.js')}}"></script>
	@endif
	@if(Route::is(['chart-morris']))
	<!-- Chart JS -->
	<script src="{{ URL::asset('/assets/plugins/morris/raphael-min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/morris/morris.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/morris/chart-data.js')}}"></script>
	@endif
	@if(Route::is(['ui-scrollbar']))
	<!-- Plyr JS -->
	<script src="{{ URL::asset('/assets/plugins/scrollbar/scrollbar.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/scrollbar/custom-scroll.js')}}"></script>
    @endif
	@if(Route::is(['ui-stickynote']))
	<!-- Stickynote JS -->
    <script src="{{ URL::asset('/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{ URL::asset('/assets/plugins/stickynote/sticky.js')}}"></script>

	@endif
	@if(Route::is(['chart-c3']))
	<!-- Chart JS -->
	<script src="{{ URL::asset('/assets/plugins/c3-chart/d3.v5.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/c3-chart/c3.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/c3-chart/chart-data.js')}}"></script>
	@endif
	@if(Route::is(['chart-flot']))
	<!-- Chart JS -->
	<script src="{{ URL::asset('/assets/plugins/flot/jquery.flot.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/flot/jquery.flot.pie.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/flot/chart-data.js')}}"></script>
	@endif
	@if(Route::is(['chart-peity']))
	<!-- Chart JS -->
	<script src="{{ URL::asset('/assets/plugins/peity/jquery.peity.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/peity/chart-data.js')}}"></script>
	@endif

	@if(Route::is(['ui-sweetalerts']))
	<!-- Sweetalert 2 -->
	<script src="{{ URL::asset('/assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>
	@endif
	@if(Route::is(['ui-clipboard']))
	<!-- Clipboard JS -->
	<script src="{{ URL::asset('/assets/plugins/clipboard/clipboard.min.js')}}"></script>
	@endif
    @if(Route::is(['ui-drag-drop']))
	<!-- Dragula JS -->
	<script src="{{ URL::asset('/assets/plugins/dragula/js/dragula.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/dragula/js/drag-drop.min.js')}}"></script>
	<script src="{{ URL::asset('/assets/plugins/dragula/js/draggable-cards.js')}}"></script>
	@endif

	@if(Route::is(['icon-feather']))
	<!-- Feather Icon JS -->
	<script src="{{ URL::asset('/assets/js/feather.min.js')}}"></script>
	@endif
	@if(!Route::is(['forgot-password','login','reset-password-success','reset-password']))
	<!-- Theme-Settings -->
	<script src="{{ URL::asset('/assets/js/theme-settings.js')}}"></script>
	@endif
	@if(!Route::is(['forgot-password','login','reset-password-success','reset-password']))

	<!-- Themescript -->
	<script src="{{ URL::asset('/assets/js/theme-script.js')}}"></script>
	@endif

	<!-- Custom JS -->
	<script src="{{ URL::asset('/assets/js/script.js')}}"></script>
