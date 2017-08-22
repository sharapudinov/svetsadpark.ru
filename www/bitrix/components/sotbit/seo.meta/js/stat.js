window.onload = function() 
{
	var xhr = new XMLHttpRequest();
	xhr.open("POST", '/bitrix/components/sotbit/seo.meta/statistics.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send('from='+document.referrer+'&to='+window.location.href);
};