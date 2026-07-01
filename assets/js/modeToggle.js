const toggleButton = document.getElementById("theme-toggle");

// Determine the preferred theme on load
const getSavedTheme = localStorage.getItem("theme");
const systemPrefersDark = window.matchMedia(
  "(prefers-color-scheme: dark)",
).matches;
const systemTheme = systemPrefersDark ? "dark" : "light";

// Apply the theme (checks storage, then system, then defaults to light)
const currentTheme = getSavedTheme || systemTheme;
document.documentElement.setAttribute("data-theme", currentTheme);

// Toggle theme on button click
toggleButton.addEventListener("click", () => {
  const currentTheme = document.documentElement.getAttribute("data-theme");
  let newTheme = "light";

  if (currentTheme === "light") {
    newTheme = "dark";
  }

  document.documentElement.setAttribute("data-theme", newTheme);
  localStorage.setItem("theme", newTheme);
});
