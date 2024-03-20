async function fetchUsers() {
	try {
		const response = await fetch(
			"https://earwig.greenriverdev.com/pages/Sprint_5/php/dbAccess/getUsers.php"
		);
		if (!response.ok) {
			throw new Error(`HTTP error: ${response.status}`);
		}
		const users = await response.json();
		const listContainer = document.getElementById("usersList");
        console.log(users);

		// Define a map for app use options
		const appUseOptionsMap = {
			"Seeking Internship": "SI",
			"Seeking a Job": "SJ",
			"Not Actively Searching": "NAS"
		};

		// 遍历所有筛选后的应用程序数据
		users.forEach((app) => {
			const appDiv = document.createElement("div");
			const appUseAbbreviation = appUseOptionsMap[app.appUseOptions] || app.appUseOptions;
			appDiv.innerHTML = `
                    <li class="row py-3 ms-1" data-userId="${app.userId}">
                    	<!--Name-->
                        <div class=" d-flex align-items-center d-none d-md-flex col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                            <span class="d-inline-block text-truncate text-start">
                                ${app.firstName} ${app.lastName}
                            </span>
                        </div>
                   
                        <!--Email-->
                        <div class="d-flex align-items-center col-7 col-sm-7 col-md-5 col-lg-4 col-xl-4 col-xxl-3">
                    		<span class="d-inline-block text-start">
                    			${app.email}
                    		</span>
                		</div>
                		
                		<!--Usage-->
                		<div class="d-flex align-items-center d-none d-lg-flex col-1 justify-content-center">
                    		<span class="d-inline-block text-start">
                    			${app.appUseOptions}
                    		</span>
                		</div>
                		
                		<!--Cohort-->
                		<div class="d-flex align-items-center d-none d-lg-flex col-1 justify-content-center">
                    		<span class="d-inline-block text-start">
                    			${app.cohortNum}
                    		</span>
                		</div>
                		
                		<!--Admin-->
                		<div class="d-flex align-items-center d-flex d-lg-flex col-1 justify-content-center">
                    		<span class="d-inline-block text-start">
                    			${app.isAdmin}
                    		</span>
                		</div>
                		
                		<!--Created-->
                		<div class="d-flex align-items-center d-none d-xxl-flex col-2 ms-3">
                   			<span class="d-inline-block text-start">
                   				${app.createdTime}
                   			</span>
                		</div>
                		
                        <!--Icons-->
                        <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 col-xxl-1 align-items-center justify-content-end d-flex icons">
                         	<a class="me-3" href="#" onclick="makeAdmin(event, ${app.userId})">
                            	<svg xmlns="http://www.w3.org/2000/svg" fill="gray" class="bi bi-person-lock" viewBox="0 0 16 16">
                                	<path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.996V14H3s-1 0-1-1 1-4 6-4q.845.002 1.544.107a4.5 4.5 0 0 0-.803.918A11 11 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664zM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                                </svg>
                            </a>
						</div>
                    </li>`;
			listContainer.appendChild(appDiv);
		});
	} catch (error) {
		console.error("Fetch error:", error);
	}
}
// 当页面加载完成时调用函数，以获取并显示数据
window.addEventListener("DOMContentLoaded", () => fetchUsers());
