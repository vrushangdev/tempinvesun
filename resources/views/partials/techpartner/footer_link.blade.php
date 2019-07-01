
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"   ></script>
<script src="{{ asset('plugins/popper/popper.js') }}"   ></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"   ></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"   ></script>
<script src="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"   ></script>
<script src="{{ asset('plugins/listjs/listjs.min.js') }}"   ></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.min.js') }}"   ></script>
<script src="{{ asset('plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>

<!-- page level-->
<script src="{{ asset('js/front/atmos.js') }}"></script>
<script src="{{ asset('plugins/dropzone/dropzone.js')}}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/pages/validation.js') }}"></script>
<script src="{{ asset('js/front/dashboard-01.js') }}" ></script>
<script src="{{ asset('js/front/datatable-data.js') }}"></script>
<script src="{{ asset('js/pages/common.js' )}}"></script> 
<script src="{{ asset('plugins/dropify/dist/js/dropify.js') }}" type="text/javascript"></script>

<script type="text/javascript">
	$('.dropify').dropify();
</script>

@if(route::is('admin.addCity') || route::is('admin.editCity'))
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCG_sqbBhTzUacobqwsf3_QNbBaKu9dM_c&signed_in=true&libraries=places"></script>
@endif	