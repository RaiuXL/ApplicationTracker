async function deleteUser(e, userId) {
	e.preventDefault();
	e.stopPropagation();
	if (confirm("Are you sure you want to delete this user?")) {
		const res = await fetch(
			"/pages/Sprint_5/php/dbAccess/deleteJobAppliedById.php",
			{
				method: "POST",
				body: JSON.stringify({
					userId: userId
				}),
				headers: {
					"Content-type": "application/json; charset=UTF-8",
				},
			}
		);

		console.log(res.status);
		if (res.status == 200) {
			alert("User Successfully Deleted");
			document.querySelector(`li[data-userid="${userId}"]`).remove();
		} else {
			alert("Could not delete application");
		}
	}
}