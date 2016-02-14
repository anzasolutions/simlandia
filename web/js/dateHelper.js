function genDays()
{
	var daysInMonth = 32;
	var year = document.getElementById('year').value;
	var month = document.getElementById('month').value;
	var newDaysInMonth = getDaysInMonth(year, month, daysInMonth);
	
	document.getElementById('day').innerHTML = '';
	
	if (newDaysInMonth != null)
		daysInMonth = newDaysInMonth;

	document.getElementById('day').innerHTML += '<option value="0">Day</option>';
	for (var i = 1; i < daysInMonth + 1; i++)
		document.getElementById('day').innerHTML += '<option value="' + i + '">' + i + '</option>';
}

function getDaysInMonth(year, month, daysInMonth)
{
	return daysInMonth - new Date(year, month, daysInMonth).getDate();
}