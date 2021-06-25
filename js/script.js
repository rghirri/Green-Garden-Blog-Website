// active link
const currentLocation = location.href;
const menuItem = document.querySelectorAll(".nav-link");
const menuLength = menuItem.length;
for (let i = 0; i < menuLength; i++) {
  if (menuItem[i].href === currentLocation) {
    menuItem[i].classList.add("active");
  }
}

// date time picker
// $("#published_at").datetimepicker();
jQuery("#published_at").datetimepicker({
  i18n: {
    de: {
      months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
      dayOfWeek: ["So.", "Mo", "Di", "Mi", "Do", "Fr", "Sa."]
    }
  },
  format: "Y-m-d H:i:s"
});
