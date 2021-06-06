var jobs = [];

$(document).ready(function() {
	getJobs();
});

function getJobs() {
	jobs = [];
	$("#jobs").find("*").remove();
	let fd = new FormData();
	fd.append("employer_id", localStorage.getItem("user_id"));
	fetch(API_URL+"/admin/get_jobs", {
		method: 'POST',
		body: fd
	})
		.then(response => response.text())
		.then(async (response) => {
			jobs = JSON.parse(response);
			for (let i=0; i<jobs.length; i++) {
				let job = jobs[i];
				$("#jobs").append("<tr>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+(i+1)+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+job['title']+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+(job['description'].length>200?job['description'].substr(0, 200):job['description'])+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td>"+job['salary']+"</td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td><button type=\"button\" class=\"mb-2 btn btn-sm btn-primary mr-1\" onclick='edit("+i+")'>Ubah</button></td>\n" +
					"\t\t\t\t\t\t\t\t\t\t<td><button type=\"button\" class=\"mb-2 btn btn-sm btn-danger mr-1\" onclick='confirmDelete("+i+")'>Hapus</button></td>\n" +
					"\t\t\t\t\t\t\t\t\t</tr>");
			}
		});
}

function add() {
	window.location.href = "http://192.168.43.254/idjobfinder/job/add";
}

function edit(index) {
	$.redirect(API_URL+"/job/edit", {
		'id': jobs[index]['id']
	});
}

function confirmDelete(index) {
	if (confirm("Apakah Anda yakin ingin menghapus pekerjaan berikut?")) {
		let fd = new FormData();
		fd.append("id", jobs[index]['id']);
		fetch(API_URL+"/admin/delete_job", {
			method: 'POST',
			body: fd
		})
			.then(response => response.text())
			.then(async (response) => {
				window.location.reload();
			});
	}
}
