const PROTOCOL = "http";
const HOST = "192.168.43.254/idjobfinder";
const API_URL = PROTOCOL+"://"+HOST;
const USERDATA_URL = PROTOCOL+"://"+HOST+"/userdata/";

$(document).ready(function() {
});

function logout() {
	$.redirect('http://192.168.43.254/idjobfinder/logout');
}

function formatMoney(amount) {
	return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}
