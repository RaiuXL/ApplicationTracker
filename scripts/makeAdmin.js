async function makeAdmin(e, userId) {
	e.preventDefault();
	e.stopPropagation();
	if (confirm("Are you sure you want to toggle admin?")) {
		const res = await fetch(
			"/pages/Sprint_5/php/dbAccess/makeAdmin.php",
			{
				method: "POST",
				body: JSON.stringify({
					userId: userId,
				}),
				headers: {
					"Content-type": "application/json; charset=UTF-8",
				},
			}
		);

		console.log(res.status);
		if (res.status == 200) {
			alert("Admin status toggled!");
		} else {
			alert("Could not complete action.");
		}
	}
}