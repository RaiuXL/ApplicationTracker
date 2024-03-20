const currFile = window.location.pathname

async function fetchData() {
	try {
		
// Get  data
		const appsResponse = await fetch(
			"https://earwig.greenriverdev.com/pages/Sprint_5/php/dbAccess/getApplications.php"
		);
		if (!appsResponse.ok) {
			throw new Error(`HTTP error: ${appsResponse.status}`);
		}
		const applications = await appsResponse.json();
		const filteredApplications = applications.filter(
			(app) => app.userId === "1"
		);
		
		displayApplications(filteredApplications);
		
// Get announcement data
		const annResponse = await fetch(
			"https://earwig.greenriverdev.com/pages/Sprint_5/php/dbAccess/getAnnouncement.php"
		);
		if (!annResponse.ok) {
			throw new Error(`HTTP error: ${annResponse.status}`);
		}
		const announcements = await annResponse.json();
		if (currFile != "/pages/Sprint_5/ApplicationDashboard.html") {
		    console.log(currFile)
		    showAnnouncements(announcements)
		}

		const recentAnnouncements = announcements
			.filter((app) => app.userId === "1")
			.slice(0, 5);
		displayAnnouncements(recentAnnouncements);
	} catch (error) {
		console.error("Fetch error:", error);
	}
}

function displayApplications(applications) {
	const listContainer = document.getElementById("applicationsList");
	const appContainer = document.getElementById("apps");
	const lateAppContainer = document.getElementById("lateApps")

	listContainer.innerHTML = ""; // Clear existing list items

	// making every other row different color
	let count = 0;
	const alternateColor = () => { count === 0 ? count++ : count--};
	let colorMap = {
		0: "#383838",
		1: "#2D2D2D"
	}

	applications.forEach((app) => {

// Create URL parameter string
let params = "?";
		const neededParams = Object.entries(app).slice(0, -1);
		neededParams.forEach(([key, value], index) => {
			params += `${key}=${encodeURIComponent(value)}${
				index < neededParams.length - 1 ? "&" : ""
			}`;
		});

		const appDiv = document.createElement("div");
		let userButtons = ""
		if (currFile != "AdminDashboard.html") {
			userButtons = `<div class="dropup-center dropup text-end w-50">
							<button type="button" 
								id="dropDown${app.userId}"
								class="p-0 img-btn ms-auto me-3" 
								data-toggle="dropdown" 
								aria-haspopup="true" 
								aria-expanded="false">
								<img src="/pages/Sprint_5/images/multidot.svg" alt="">
							</button>
							<div class="dropdown-menu more-options-btn" aria-labelledby="dropDown${app.userId}">
								<a class="dropdown-item px-auto" href="/pages/Sprint_5/editApplication.html${params}">
									<svg xmlns="http://www.w3.org/2000/svg" fill="gray" class="bi bi-pencil" viewBox="0 0 16 16">
										<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
									</svg>
								</a>
								<a class="dropdown-item px-auto mt-2" href="#" onclick="deleteApplication(event, ${app.applicationId})">
									<svg xmlns="http://www.w3.org/2000/svg" fill="gray" class="bi bi-trash3" viewBox="0 0 16 16">
										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
										<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									</svg>
								</a>
							</div>
						</div>`
		}

		appDiv.innerHTML = `
            <li class="d-flex w-100 py-3 ps-3" style="background-color: ${colorMap[count]}" data-appId="${
				app.applicationId
			}" data-sqlDate="${app.dateApplied}">
            	<div class="col-2 col-md-1 col-lg-2 d-none d-sm-flex align-items-center">
					<span class="w-100 d-inline text-truncate text-start">
						 ${app.dateApplied.substring(
							5
						)}-${app.dateApplied.substring(2, 4)}
					</span>
				</div>
					<div class="col-7 col-sm-5 ps-sm-4 ps-lg-0 col-md-4 col-lg-4 col-xxl-3 d-flex align-items-center justify-content-between">
                        <span class="inline-block text-truncate pe-2">${app.jobPosition}</span>
                    </div>
					<div class="col-4 col-md-3 col-xl-3 col-xxl-2 d-none d-md-flex d-lg-none d-xl-flex align-items-center justify-content-between">
                        <span>${app.organization}</span>
                    </div>	
                    <div class="d-flex d-flex col-4 col-md-3 col-lg-5 col-xl-2 align-items-center justify-content-start">
                        <div class="align-items-center col-5 col-md-6 col-lg-5 col-xl-8 col-xxl-8 d-flex">
                            <span class="d-inline-block">
                                ${app.status}
                            </span>
                        </div>

                        <div class="text-center align-items-center d-none col-3 justify-content-center">
                            <span class="d-inline-block text-center">
                                Notes
                            </span>
                        </div>

                        <div class="d-none d-sm-flex align-items-center justify-content-center col-3">
                            <a href=${app.descriptionURL}>
                            	<i id="appLink" class="bi bi-box-arrow-up-right"></i>
							</a>
                        </div>
                    </div>
                    <div
                            style="width: max-content"
                            class="ms-3 ms-lg-4 d-none d-xxl-flex align-items-center justify-content-between">
                        <span class="text-truncate">${formatDate(app.followUpDate)}</span>
                    </div>
						${userButtons}
					</div>
				</div>
            </li>
        `;
		listContainer.append(appDiv)
		alternateColor()
		
		// Applications +/- 5 days from current
		const currentApp = recentApplications(app)
		if (currentApp) {
			const reminderDiv = document.createElement("div");
			reminderDiv.innerHTML = `
            <li class="list-item list-unstyled">
				<a href="/pages/Sprint_5/editApplication.html${params}" class="my-3">
					<button class=" align-items-center py-2 d-flex flex-nowrap align-content-stretch w-100 border-0 bg-transparent text-start">
						<span class="announcement-date ps-1 me-3">
							${formatDate(app.followUpDate)}
						</span>
						<span class="d-inline text-truncate ps-2 col-6">
							${app.jobPosition}
						</span>
						<i class="bi bi-arrow-bar-right ms-auto pe-1" style="font-size:1.4rem; padding-top: .125em;"></i>
					</button>
				</a>
            </li>
			`;
			if (currentApp[1] == "late") {
				lateAppContainer.append(reminderDiv);
			} else {
				appContainer.append(reminderDiv)
			}
		}
	})
}

function showAnnouncements(announcements) {
	const listContainer = document.getElementById("announcementsList");

	// making every other row different color
	let count = 0;
	const alternateColor = () => { count === 0 ? count++ : count--};
	let colorMap = {
		0: "#383838",
		1: "#2D2D2D"
	}

	announcements.forEach((app) => {
		
// Create URL parameter string

		const appDiv = document.createElement("div");
		appDiv.innerHTML = `
            <li class="d-flex w-100 py-3 ps-3" style="background-color: ${colorMap[count]}">
            	<div class="col-2 col-md-1 col-lg-2 d-none d-sm-flex align-items-center">
					<span class="w-100 d-inline text-truncate text-start">
						 ${formatDate(app.createdDate)}
					</span>
				</div>
					<div class="col-7 col-sm-5 ps-sm-4 ps-lg-0 col-md-4 col-lg-4 col-xxl-3 d-flex align-items-center justify-content-between">
                        <span class="inline-block text-truncate pe-2">${app.title}</span>
                    </div>
					<div class="col-4 col-md-3 col-xl-3 col-xxl-2 d-none d-md-flex d-lg-none d-xl-flex align-items-center justify-content-between">
                        <span>${app.employer}</span>
                    </div>	
                    <div class="d-flex d-flex col-4 col-md-3 col-lg-5 col-xl-2 align-items-center justify-content-start">
                        <div class="align-items-center col-7 col-sm-5 col-md-6 col-lg-5 col-xl-8 col-xxl-8 d-flex">
                            <span class="d-inline-block">
                                ${app.jobType}
                            </span>
                        </div>
                        <div class="d-none d-sm-flex align-items-center justify-content-center col-3">
                            <a href=${app.location}>
                            	<i id="appLink" class="bi bi-box-arrow-up-right"></i>
							</a>
                        </div>
                    </div>
                    <div style="width: max-content" class="ms-3 ms-lg-4 d-none d-xxl-flex align-items-center justify-content-between">
                        <span>${app.email}</span>
                    </div>
					<div class="ms-auto me-3 align-items-center justify-content-center">
						<a class="ms-auto me-3" href="/pages/Sprint_5/view-announcement.html?announcementId=${app.announcementId}">
							<i class="bi bi-arrow-bar-right"></i>
						</a>
					</div>
				</div>
            </li>
        `;
		listContainer.append(appDiv)
		alternateColor()
	})
}

function displayAnnouncements(announcements) {
    const listContainer = document.getElementById("announcements");
    listContainer.innerHTML = "";

    const now = new Date();
    const fiveDaysInMilliseconds = 5 * 24 * 60 * 60 * 1000;

    const recentAnnouncements = announcements.filter(app => {
        const appDate = new Date(app.createdDate);
        return Math.abs(now - appDate) <= fiveDaysInMilliseconds;
    });

    const sortedAnnouncements = recentAnnouncements.sort(
        (a, b) => new Date(b.createdDate) - new Date(a.createdDate)
    );

    sortedAnnouncements.forEach((app) => {
        const formattedDate = formatDate(app.createdDate);
        const appDiv = document.createElement("div");
        appDiv.innerHTML = `
            <li class="list-item list-unstyled">
                <a href="/pages/Sprint_5/view-announcement.html?announcementId=${app.announcementId}" class="my-3">
                    <button class=" align-items-center py-2 d-flex flex-nowrap align-content-stretch w-100 border-0 bg-transparent text-start">
                        <div class="d-flex flex-column col-10 my-2">
                            <span class="announcement-date ps-1 me-3 w-100">${formattedDate}</span>
                            <span class="d-inline text-truncate ps-1 col-6 w-100">
                                ${app.title}
                            </span>
                        </div>
                        <i class="bi bi-arrow-bar-right ms-auto pe-1" style="font-size:1.4rem; padding-top: .125em;"></i>
                    </button>
                </a>
            </li>
        `;
        listContainer.appendChild(appDiv);
    });
}


function recentApplications(app) {
	const followUp = new Date(`${app.followUpDate}\n`);
	const beforeFive = new Date(`${app.followUpDate}\n`);
	const afterFive = new Date(`${app.followUpDate}\n`);
	const currDate = new Date();

	beforeFive.setDate(beforeFive.getDate() - 5);
	afterFive.setDate(afterFive.getDate() + 5);
	if (currDate >= beforeFive && currDate <= afterFive) {
		if (followUp >= currDate) {
			return [app.followUpDate, ""]
		} else {
			return [app.followUpDate, "late"];
		}
	}
}

window.addEventListener("load", fetchData);
