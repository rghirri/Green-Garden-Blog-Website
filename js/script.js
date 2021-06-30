// active menu link
// const currentLocation = location.href;
// const menuItem = document.querySelectorAll(".nav-link");
// const menuLength = menuItem.length;
// for (let i = 0; i < menuLength; i++) {
//   if (menuItem[i].href === currentLocation) {
//     menuItem[i].classList.add("active");
//   }
// }

// date time picker
jQuery("#published_at").datetimepicker({
  format: "Y-m-d H:i:s"
});

// delete form

/**
 * Send links of class "delete" via post after a confirmation dialog
 */
$("a.delete").on("click", function (e) {
  e.preventDefault();

  if (confirm("Are you sure?")) {
    var frm = $("<form>");
    frm.attr("method", "post");
    frm.attr("action", $(this).attr("href"));
    frm.appendTo("body");
    frm.submit();
  }
});

// Validation

$.validator.addMethod(
  "dateTime",
  function (value, element) {
    return value == "" || !isNaN(Date.parse(value));
  },
  "Must be a valid date and time"
);

$("#formArticle").validate({
  rules: {
    title: {
      required: true
    },
    content: {
      required: true
    },
    published_at: {
      dateTime: true
    }
  }
});
