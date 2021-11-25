jQuery(function ($) {

	$(".sidebar-dropdown > a").click(function () {
		$(".sidebar-submenu").slideUp(200);
		if (
			$(this)
				.parent()
				.hasClass("active")
		) {
			$(".sidebar-dropdown").removeClass("active");
			$(this)
				.parent()
				.removeClass("active");
		} else {
			$(".sidebar-dropdown").removeClass("active");
			$(this)
				.next(".sidebar-submenu")
				.slideDown(200);
			$(this)
				.parent()
				.addClass("active");
		}
	});

	$("#close-sidebar").click(function () {
		$(".page-wrapper").removeClass("toggled");
	});
	$("#show-sidebar").click(function () {
		$(".page-wrapper").addClass("toggled");
	});



	$(document).ready(function () {
		var x = window.matchMedia("(max-width: 990px)");
		myFunction(x); // Call listener function at run time
		x.addListener(myFunction); // Attach listener function on state changes

		function myFunction(x) {
			if (x.matches) { // If media query matches
				$(".page-wrapper").removeClass("toggled");
				$("#page").click(function () {
					$(".page-wrapper").removeClass("toggled");
				});
			} else {
				$(".page-wrapper").addClass("toggled");
			}
		};
	});



});
