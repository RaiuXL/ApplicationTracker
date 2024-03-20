async function fetchUsers() {
    try {
        const response = await fetch("https://earwig.greenriverdev.com/pages/Sprint_5/php/dbAccess/getUsers.php");
        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }
        const announcements = await response.json();
        const listContainer = document.getElementById("announcementList");

        announcements.forEach((app) => {
            const appDiv = document.createElement("div");
            appDiv.className = "announcement-item"; // Added class for easy selection
            appDiv.innerHTML = `
                <li class="row py-3 ms-1" data-announcementId="${app.announcementId}">
                    <div class="d-flex align-items-center col-1">
                        <span>${app.title}</span>
                    </div>
                    <div class="d-flex align-items-center col-1">
                        <span>${app.jobType}</span>
                    </div>
                    <div class="d-flex align-items-center col-1">
                        <span>${app.location}</span>
                    </div>
                    <div class="d-flex align-items-center col-1">
                        <span>${app.employer}</span>
                    </div>
                    <div class="d-flex align-items-center col-1">
                        <span>${app.moreInfo}</span>
                    </div>
                    <div class="d-flex align-items-center col-2">
                        <span>${app.url}</span>
                    </div>
                    <div class="d-flex align-items-center col-2">
                        <span>${app.email}</span>
                    </div>
                    <div class="d-flex align-items-center col-2">
                        <span>${new Date(app.createdDate).toLocaleDateString()}</span>
                    </div>
                </li>`;
            listContainer.appendChild(appDiv);
        });
    } catch (error) {
        console.error("Fetch error:", error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetchUsers();

    const searchInput = document.getElementById('searchAnnouncementsInput');
    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.toLowerCase();
        const announcementItems = document.querySelectorAll("#announcementList .announcement-item");

        announcementItems.forEach(item => {
            const textContent = item.textContent.toLowerCase();
            const match = textContent.includes(searchValue);
            item.style.display = match ? '' : 'none';
        });
    });
});
