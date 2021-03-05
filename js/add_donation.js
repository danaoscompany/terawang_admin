function save() {
	let name = $("#name").val().trim();
	let bank = $("#bank").prop('selectedIndex');
	let accountNumber = $("#account-number").val().trim();
	if (name == "" || bank == 0 || accountNumber == "") {
		alert("Mohon lengkapi data");
		return;
	}
	let fd = new FormData();
	fd.append("name", name);
	fd.append("bank", $("#bank").val().toLowerCase());
	fd.append("account_number", accountNumber);
	fetch(API_URL+"/admin/add_donation", {
		method: 'POST',
		body: fd
	})
		.then(response => response.text())
		.then(async (response) => {
			window.location.href = "http://terawang.co/admin/donation";
		});
}

function cancel() {
	window.history.back();
}
