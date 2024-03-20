async function fetchUsers() {
    try {
        const response = await fetch("https://earwig.greenriverdev.com/pages/Sprint_5/php/dbAccess/getUsers.php");
        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }
        const users = await response.json();
        const listContainer = document.getElementById("usersList");

        const appUseOptionsMap = {
            "Seeking Internship": "SI",
            "Seeking a Job": "SJ",
            "Not Actively Searching": "NAS"
        };

        users.forEach((user) => {
            const appDiv = document.createElement("div");
            appDiv.className = "user-item";
            const appUseAbbreviation = appUseOptionsMap[user.appUseOptions] || user.appUseOptions;

            appDiv.innerHTML = `
                <li class="row py-3 ms-1" data-userId="${user.userId}">
                    <div class="d-flex align-items-center col-4">
                        <span>${user.firstName} ${user.lastName}</span>
                    </div>
                    <div class="d-flex align-items-center col-3">
                        <span>${user.email}</span>
                    </div>
                    <div class="d-flex align-items-center col-1">
                        <span>${appUseAbbreviation}</span>
                    </div>
                    <div class="d-flex align-items-center col-1">
                        <span>${user.cohortNum}</span>
                    </div>
                    <div class="d-flex align-items-center col-1">
                        <span>${user.isAdmin}</span>
                    </div>
                    <div class="d-flex align-items-center col-2">
                        <span>${user.createdTime}</span>
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

    const searchInput = document.getElementById('searchUsersInput');
    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.toLowerCase();
        const userItems = document.querySelectorAll('#usersList .user-item');

        userItems.forEach(item => {
            const textContent = item.textContent.toLowerCase();
            const match = textContent.includes(searchValue);
            item.style.display = match ? '' : 'none';
        });
    });
});
