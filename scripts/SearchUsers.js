async function fetchUsers() {
    try {
        const response = await fetch("https://earwig.greenriverdev.com/pages/Sprint_5/php/dbAccess/getUsers.php");
        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }
        const users = await response.json();
        const listContainer = document.getElementById("usersList");

        let count = 0;
        const alternateColor = () => (count = count === 0 ? 1 : 0);
        const colorMap = { 0: "#383838", 1: "#2D2D2D" };

        users.forEach((user) => {
            const userDiv = document.createElement("div");
            userDiv.className = "user-item";
            userDiv.style.backgroundColor = colorMap[count];
            alternateColor();

            userDiv.innerHTML = `
               <li class="d-flex w-100 py-3 ps-3" data-userId="${app.userId}" style="background-color: ${colorMap[count]}">
						<!--Name-->
                        <div class="col-3 col-md-3 d-none d-sm-flex align-items-center">
                            <span class="d-inline-block text-truncate text-start">
                                ${app.firstName} ${app.lastName}
                            </span>
                        </div>
                        <div class="col-5 col-sm-4 col-md-3 col-lg-4 col-xl-4 col-xxl-3 d-flex align-items-center justify-content-between">
                            <span class="text-truncate">${app.email}</span>
                        </div>   
                        <div class="d-flex d-flex col-5 col-sm-4 col-md-3 align-items-center justify-content-evenly text-center">
                        	<div class="align-items-center col-4 d-flex justify-content-center">
								<span class="d-inline-block text-start">
									${app.cohortNum}
								</span>
							</div>
							
							<div class="text-center align-items-center d-none d-sm-flex d-lg-none d-xl-flex col-4 justify-content-center">
								<span class="d-inline-block text-start">
									${keyCode}
								</span>
                			</div>
                			
                			<div class="d-flex align-items-center justify-content-center col-4">
								<img style="margin-bottom: 0; opacity: 1" src="${adminMap[app.isAdmin]}" alt="">
                			</div>
						</div>
						<div 
							style="width: max-content"
							class="ms-3 ms-lg-4 d-none d-md-flex d-lg-none d-xxl-flex align-items-center justify-content-between">
                            <span class="text-truncate">${formatDate(app.createdTime)}*${app.createdTime.substring(11)}</span>
                        </div>  
						<div class="dropup-center dropup text-end w-50">
							<button type="button" 
								id="dropDown${app.userId}"
								class="p-0 img-btn ms-auto me-3" 
								data-toggle="dropdown" 
								aria-haspopup="true" 
								aria-expanded="false">
								<img src="/pages/Sprint_5/images/multidot.svg" alt="">
							</button>
							<div class="dropdown-menu more-options-btn" aria-labelledby="dropDown${app.userId}">
								<a href="#" onclick="deleteUser(event, ${app.userId})" class="dropdown-item px-auto">
									<svg id="deleteUser" xmlns="http://www.w3.org/2000/svg" fill="gray" class="bi bi-trash3" viewBox="0 0 16 16">
										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
										<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									</svg>
								</a>
								<a class="dropdown-item px-auto" href="#" onclick="makeAdmin(event, ${app.userId})">
									<svg xmlns="http://www.w3.org/2000/svg" fill="gray" class="bi bi-person-lock" viewBox="0 0 16 16">
										<path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.996V14H3s-1 0-1-1 1-4 6-4q.845.002 1.544.107a4.5 4.5 0 0 0-.803.918A11 11 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664zM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
									</svg>
								</a>
							</div>
						</div>
                    </li>`;
            listContainer.appendChild(userDiv);
        });
    } catch (error) {
        console.error("Fetch error:", error);
    }
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString();
}

document.addEventListener("DOMContentLoaded", () => {
    fetchUsers();

    const searchInput = document.getElementById('searchUsersInput');
    searchInput.addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const userItems = document.querySelectorAll('#usersList .user-item');

        userItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            const match = text.includes(searchValue);
            item.style.display = match ? '' : 'none';
        });
    });
});
