var id;

$(document).ready(function() {
	id = parseInt($("#edited-job-id").val().trim());
	let fd = new FormData();
	fd.append("id", id);
	fetch(API_URL+"/admin/get_job_by_id", {
		method: 'POST',
		body: fd
	})
		.then(response => response.text())
		.then(response => {
			let job = JSON.parse(response);
			$("#title").val(job['title']);
			$("#description").val(job['description']);
			$("#salary").val(job['salary']);
			$("#processing_time").val(job['processing_time']);
			let processingTimeUnit = job['processing_time_unit'];
			if (processingTimeUnit == 'hour') {
				$("#processing_time_unit").prop('selectedIndex', 0);
			} else if (processingTimeUnit == 'day') {
				$("#processing_time_unit").prop('selectedIndex', 1);
			} else if (processingTimeUnit == 'week') {
				$("#processing_time_unit").prop('selectedIndex', 2);
			} else if (processingTimeUnit == 'month') {
				$("#processing_time_unit").prop('selectedIndex', 3);
			}
			$("#address").val(job['address']);
		});
});

function save() {
	let title = $("#title").val().trim();
	let description = $("#description").val().trim();
	let salary = $("#salary").val().trim();
	let processingTime = $("#processing_time").val().trim();
	let processingTimeUnit = $("#processing_time_unit").prop('selectedIndex');
	let address = $("#address").val().trim();
	if (title.trim() == "" || description.trim() == "" || salary.trim() == "" || processingTime.trim() == ""
		|| address.trim() == "") {
		alert("Mohon lengkapi data");
		return;
	}
	let fd = new FormData();
	fd.append("id", id);
	fd.append("employer_id", localStorage.getItem("user_id"));
	fd.append("title", title);
	fd.append("description", description);
	fd.append("salary", salary);
	fd.append("processing_time", processingTime);
	fd.append("processing_time_unit", processingTimeUnit==0?'hour':processingTimeUnit==1?'day':processingTimeUnit==2?'week':processingTimeUnit==3?'month':'');
	fd.append("address", address);
	fetch(API_URL+"/admin/update_job", {
		method: 'POST',
		body: fd
	})
		.then(response => response.text())
		.then(response => {
			window.history.back();
		});
}

function cancel() {
	window.history.back();
}
