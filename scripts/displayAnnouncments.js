async function fetchUsers() {
    try {
        const response = await fetch(
            "https://earwig.greenriverdev.com/pages/Sprint_5/php/dbAccess/getUsers.php"
        );
        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }
        const announcements = await response.json();
        const listContainer = document.getElementById("announcementList");
        console.log(announcements);

        // 遍历所有筛选后的应用程序数据
        announcements.forEach((app) => {
            const appDiv = document.createElement("div");
            appDiv.innerHTML = `
                    <li class="row py-3 ms-1" data-announcementId="${app.announcementId}">
                    	<!--Title-->
                        <div class=" d-flex align-items-center col-1">
                            <span class="d-inline-block text-truncate text-start">
                                ${app.title}
                            </span>
                        </div>
                   
                        <!--Job Type-->
                        <div class="d-flex align-items-center col-1">
                    		<span class="d-inline-block text-start">
                    			${app.jobType}
                    		</span>
                		</div>
                		
                		<!--Location-->
                		<div class="d-flex align-items-center col-1">
                    		<span class="d-inline-block text-start">
                    			${app.location}
                    		</span>
                		</div>
                		
                		<!--Employer-->
                		<div class="d-flex align-items-center col-1">
                    		<span class="d-inline-block text-start">
                    			${app.employer}
                    		</span>
                		</div>
                		
                		<!--More Info-->
                		<div class="d-flex align-items-center col-1">
                    		<span class="d-inline-block text-start">
                    			${app.moreInfo}
                    		</span>
                		</div>
                		
                		<!--URL-->
                		<div class="d-flex align-items-center d-none d-xxl-flex col-2 ms-3">
                   			<span class="d-inline-block text-start">
                   				${app.url}
                   			</span>
                		</div>
                		
                        <!--Email-->
                        <div class="d-flex align-items-center d-none d-xxl-flex col-2 ms-3">
                   			<span class="d-inline-block text-start">
                   				${app.email}
                   			</span>
                		</div>
                		
                		<!--Created Date-->
                		<div class="d-flex align-items-center d-none d-xxl-flex col-2 ms-3">
                   			<span class="d-inline-block text-start">
                   				${app.createdDate}
                   			</span>
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
