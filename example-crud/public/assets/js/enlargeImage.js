// public/asset/js/enlargeImage.js
$(document).ready(function () {
    $(document).on("click", ".enlarge-image-trigger", function () {
        var imgSrc = $(this).attr("src");

        // Set the source of the enlarged image
        $("#enlargedImg").attr("src", imgSrc);

        // Show the modal
        $("#enlargeImageModal").modal("show");
    });

    $("#enlargeImageModal").on("hidden.bs.modal", function () {
        // Clear the source of the enlarged image when the modal is closed
        $("#enlargedImg").attr("src", "");
    });
});
