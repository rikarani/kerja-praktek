// import "jsvectormap/dist/jsvectormap.min.css";
import "flatpickr/dist/flatpickr.min.css";

import flatpickr from "flatpickr";
import { Indonesian } from "flatpickr/dist/l10n/id";

import chart01 from "./components/charts/chart-01";
// import chart02 from "./components/charts/chart-02";
// import chart03 from "./components/charts/chart-03";
// import map01 from "./components/map-01";
// import "./components/calendar-init.js";
// import "./components/image-resize";

// // Init flatpickr
flatpickr(".datepicker", {
  locale: Indonesian,
  mode: "single",
  static: true,
  monthSelectorType: "static",
  dateFormat: "j F Y",
  defaultDate: [new Date()],
  prevArrow:
    '<svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.25 6L9 12.25L15.25 18.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
  nextArrow:
    '<svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.75 19L15 12.75L8.75 6.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
});

// // Document Loaded
document.addEventListener("DOMContentLoaded", () => {
  chart01();
  // chart02();
  // chart03();
  // map01();
});

// // Get the current year
// const year = document.getElementById("year");
// if (year) {
//   year.textContent = new Date().getFullYear();
// }

// // For Copy to Clipboard
// document.addEventListener("DOMContentLoaded", () => {
//   const copyInput = document.getElementById("copy-input");
//   if (copyInput) {
//     // Select the copy button and input field
//     const copyButton = document.getElementById("copy-button");
//     const copyText = document.getElementById("copy-text");
//     const websiteInput = document.getElementById("website-input");

//     // Event listener for the copy button
//     copyButton.addEventListener("click", () => {
//       // Copy the input value to the clipboard
//       navigator.clipboard.writeText(websiteInput.value).then(() => {
//         // Change the text to "Copied"
//         copyText.textContent = "Copied";

//         // Reset the text back to "Copy" after 2 seconds
//         setTimeout(() => {
//           copyText.textContent = "Copy";
//         }, 2000);
//       });
//     });
//   }
// });

// document.addEventListener("DOMContentLoaded", function () {
//   const searchInput = document.getElementById("search-input");
//   const searchButton = document.getElementById("search-button");

//   // Function to focus the search input
//   function focusSearchInput() {
//     searchInput.focus();
//   }

//   // Add click event listener to the search button
//   searchButton.addEventListener("click", focusSearchInput);

//   // Add keyboard event listener for Cmd+K (Mac) or Ctrl+K (Windows/Linux)
//   document.addEventListener("keydown", function (event) {
//     if ((event.metaKey || event.ctrlKey) && event.key === "k") {
//       event.preventDefault(); // Prevent the default browser behavior
//       focusSearchInput();
//     }
//   });

//   // Add keyboard event listener for "/" key
//   document.addEventListener("keydown", function (event) {
//     if (event.key === "/" && document.activeElement !== searchInput) {
//       event.preventDefault(); // Prevent the "/" character from being typed
//       focusSearchInput();
//     }
//   });
// });
