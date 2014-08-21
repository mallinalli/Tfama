<?php
  $test = date_create();
  /*Día - Mes - Año  Hora - Minuto - Segundo*/
  $esteDia = date('d');
  $anotherTest = date_create($esteDia.'-03-2014 16:55:00');

  $f1 = date_format($test,'Y-m-d  H:i:s');
  $f2 = date_format($anotherTest,'Y-m-d  H:i:s');
  
  $purinto = date_diff($test,$anotherTest);
?>

<script>
	var dateTimer;
	var iDay = parseInt($('#day').html());
	var iHour = parseInt($('#hour').html());
	var iMin = parseInt($('#min').html());
	var iSec = parseInt($('#sec').html());

	if ($('#timer_sign').data('sign') == '+') {
		dateTimerInitiate();
	} else {
		timerEnded();
		$('#day').html('0');
		$('#hour').html('0');
		$('#min').html('0');
		$('#sec').html('0');
	}

	function dateTimerInitiate(){
		clearInterval(dateTimer);
		dateTimer =  setInterval (function(){
			iSec--;
			if (iSec == 0 && iMin == 0 && iHour == 0 && iDay == 0) {
					timerEnded();
			} else if (iSec == 0) {
				iSec = 59;
				iMin--;
				if (iMin == -1) {
					iMin = 59;
					iHour--;
					if (iHour == -1) {
						iHour = 23;
						iDay --;
						$('#day').html(iDay);
					};
					$('#hour').html(iHour);
				};
				$('#min').html(iMin);
			}
			$('#sec').html(iSec);
		}, 1000);
	};

	function timerEnded(){
		clearInterval(dateTimer);
		$('#final').html('<iframe width="420" height="315" src="//www.youtube.com/embed/9jK-NcRmVcw?autoplay=1&start=13" frameborder="0" allowfullscreen></iframe>');
		$('#final').slideDown();
	}

	$('#final_show').on('click',function(){
		$('#final').slideToggle();
	});

</script>