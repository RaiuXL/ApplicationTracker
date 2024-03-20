async function deleteApplication(e, appId) {
    e.preventDefault();
    e.stopPropagation();
    if (confirm('Are you sure you want to delete this application?')) {
        const res = await fetch("/pages/Sprint_5/php/dbAccess/deleteJobAppliedById.php", {
    		method: "POST",
    		body: JSON.stringify({
    			userId: 1,
    			applicationId : appId
    		}),
    		headers: {
    			"Content-type": "application/json; charset=UTF-8",
    		},
    	})
    	
    	console.log(res.status)
    	if (res.status == 200) {
    	    alert("Application Successfully Deleted");
    	    document.querySelector(`li[data-appid="${appId}"]`).remove();
    	} else {
    	    alert("Could not delete application");
    	}
    }
}