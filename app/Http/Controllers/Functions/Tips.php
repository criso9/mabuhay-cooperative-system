//how many months passed
		$deduction = date("m") - 1;
		//get the current date
		$curr_month = date('Y-m-d');
	
		//get previous month/s within a year
		$until = new DateTime($curr_month);
		$interval = new DateInterval('P'.$deduction.'M');
		
		$start = $until->sub($interval);
		$end = new DateTime($curr_month);
		$end->add(new DateInterval("P1M"));
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);

		$periods = array();

		foreach ($period as $dt) {
		    // echo $dt->format("Y-m") . "<br>\n";
		    array_push($periods,  $dt->format("M"));
		}

		//get list of years since COOP founded date
		$start_year = new DateTime("2014-05-01");
		$end_year = new DateTime($curr_month);
		$end_year->add(new DateInterval("P1Y"));
		$interval_year = DateInterval::createFromDateString('1 year');
		$period_year   = new DatePeriod($start_year, $interval_year, $end_year);

		$years = array();

		foreach ($period_year as $year) {
		    // echo $dty->format("Y") . "<br>\n";
		    array_push($years,  $year->format("Y"));
		}

		rsort($years);






//////// ========================= /////////

href="javascript:document.getElementById('reg-approval-form').submit();