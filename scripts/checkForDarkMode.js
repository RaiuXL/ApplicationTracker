const theme = window.localStorage.getItem("darkMode");
if (theme == "true" || theme == null) {
    console.log("Dark Mode is On")
    document.documentElement.style.backgroundColor = "#333333"
    document.documentElement.classList.add("darkMode");
    if (theme == null) {
        window.localStorage.setItem("darkMode", "true");
    }
}
