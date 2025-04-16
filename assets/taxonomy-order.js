jQuery(document).ready(function ($) {
  let $tbody = $("tbody");

  // Function to show toast message
  function showToast(message, type = "success") {
    let toastContainer = document.getElementById("tovp_taxonomy_ordering-toast-container");

    let toast = document.createElement("div");
    toast.className = `tovp_taxonomy_ordering-toast ${type}`;
    toast.innerText = message;

    toastContainer.appendChild(toast);

    setTimeout(() => {
      toast.classList.add("show");
    }, 100); // Small delay to allow CSS transition

    setTimeout(() => {
      toast.classList.remove("show");
      setTimeout(() => {
        toast.remove();
      }, 500);
    }, 3000); // Message disappears after 3 seconds
  }

  // Sortable functionality
  $tbody.sortable({
    items: "tr",
    handle: ".order-handle",
    update: function () {
      let order = [];
      $(".term-order").each(function () {
        order.push($(this).data("term-id"));
      });

      $.post(
        tovpAjax.ajax_url,
        {
          action: "tovp_save_taxonomy_order",
          nonce: tovpAjax.nonce,
          order: order,
        },
        function (response) {
          if (response.success) {
            showToast(response.data.message, "success");
          } else {
            showToast(response.data.message, "error");
          }
        }
      );
    },
  });
});
