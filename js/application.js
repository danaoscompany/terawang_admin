var applications = [];

$(document).ready(function() {
	getApplications();
});

function getApplications() {
	applications = [];
	$("#applications").find("*").remove();
	let fd = new FormData();
	fd.append("employer_id", localStorage.getItem("user_id"));
	fetch(API_URL+"/admin/get_applications", {
		method: 'POST',
		body: fd
	})
		.then(response => response.text())
		.then(response => {
			applications = JSON.parse(response);
			for (let i=0; i<applications.length; i++) {
				let application = applications[i];
				let status = application['status'];
				$("#applications").append("<tr>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+(i+1)+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+application['user']['name']+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+application['job']['title']+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+application['description']+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+moment(application['date'], 'YYYY-MM-DD HH:mm:ss').format('D MMMM YYYY HH:mm:ss')+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td style='color: "+(status=='approved'?'#2ecc71':status=='rejected'?'#e74c3c':'')+"'>"+(status=='pending'?'PENDING':status=='approved'?'DISETUJUI':status=='rejected'?'DITOLAK':status)+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td><div class=\"btn-group btn-group-sm\">\n" +
					"                            <button type=\"button\" class=\"btn btn-white\" onclick='updateApplicationStatus("+i+", \"approved\")'>\n" +
					"                              <span class=\"text-success\">\n" +
					"                                <i class=\"material-icons\">check</i>\n" +
					"                              </span> Approve </button>\n" +
					"                            <button type=\"button\" class=\"btn btn-white\" onclick='updateApplicationStatus("+i+", \"rejected\")'>\n" +
					"                              <span class=\"text-danger\">\n" +
					"                                <i class=\"material-icons\">clear</i>\n" +
					"                              </span> Reject </button>\n" +
					"                          </div></td>\n" +
					"\t\t\t\t\t\t\t\t\t</tr>");
			}
		});
}

function updateApplicationStatus(index, status) {
	let fd = new FormData();
	fd.append("id", applications[index]['id']);
	fd.append("status", status);
	fetch(API_URL+"/admin/update_application_status", {
		method: 'POST',
		body: fd
	})
		.then(response => response.text())
		.then(response => {
			getApplications();
		});
}
