$(document).ready(function() {
	fetch(API_URL+"/admin/get_settings")
		.then(response => response.text())
		.then(async (response) => {
			let settings = JSON.parse(response);
			$("#free-questions-per-month").val(settings['free_questions_per_month']);
		});
});

function cancel() {
	window.history.back();
}

function save() {
	let freeQuestionsPerMonth = $("#free-questions-per-month").val().trim();
	if (freeQuestionsPerMonth == "") {
		alert("Mohon lengkapi data");
		return;
	}
	let fd = new FormData();
	fd.append("free_questions_per_month", freeQuestionsPerMonth);
	fetch(API_URL+"/admin/update_free_questions_per_month", {
		method: 'POST',
		body: fd
	})
		.then(response => response.text())
		.then(async (response) => {
			window.location.reload();
		});
}
