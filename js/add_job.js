$(document).ready(function() {
	$("#title").val("a");
	$("#description").val("b");
	$("#salary").val("10000000");
	$("#processing_time").val("2");
	$("#processing_time_unit").prop('selectedIndex', 2);
	$("#address").val("jakarta");
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
	fd.append("employer_id", localStorage.getItem("user_id"));
	fd.append("title", title);
	fd.append("description", description);
	fd.append("salary", salary);
	fd.append("processing_time", processingTime);
	fd.append("processing_time_unit", processingTimeUnit==0?'hour':processingTimeUnit==1?'day':processingTimeUnit==2?'week':processingTimeUnit==3?'month':'');
	fd.append("address", address);
	fetch(API_URL+"/admin/add_job", {
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
