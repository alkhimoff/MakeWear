<?
if ($_SESSION['status']=="admin"){




	$center.="

		<script>
			$(document).ready(function(){
				$('#fromdown').datepicker({
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
			      	changeYear: true,
					onClose: function( selectedDate ) {
						$( '#todown' ).datepicker( 'option', 'minDate', selectedDate );
					}
				});

				$('#todown').datepicker({
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
			      	changeYear: true,
					onClose: function( selectedDate ) {
						$('#fromdown').datepicker( 'option', 'maxDate', selectedDate );
					}
				});
				$('#butdown').click(function(){
					var from=$('#fromdown').val();
					var to=$('#todown').val();

					if(from==''){from=0}
					if(to==''){to=0}

					var path=window.location.href;

					var hhref=path+'&from='+from+'&to='+to;

					// alert(hhref);
					window.location.href='/modules/commodities/download/sales.php?from='+from+'&to='+to;
				});
			});
		</script>
		<br/>
		<h3>Период дата</h3>
		<form  method='get'>
			<label>с </label><input type='text' id='fromdown' name='from' />
			<label>до </label> <input type='text' id='todown' name='to' /> <br/>
			<input type='button' id='butdown' value='выгрузить'/>
		</form>";
}

?>
