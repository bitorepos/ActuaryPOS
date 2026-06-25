

$(function () {
	"use strict";

	var MOBILE_BREAKPOINT = 1024;

	function isMobileViewport() {
		return window.innerWidth <= MOBILE_BREAKPOINT;
	}

	function showOverlay() {
		$(".sidebar-overlay").fadeIn(200);
	}

	function hideOverlay() {
		$(".sidebar-overlay").fadeOut(200);
	}

	var _savedScrollY = 0;

	function closeSidebar() {
		$(".wrapper").removeClass("toggled sidebar-hovered");
		hideOverlay();
		if (isMobileViewport()) {
			document.body.classList.remove("sidebar-open");
			document.body.style.top = "";
			window.scrollTo(0, _savedScrollY);
		}
	}

	function openSidebar() {
		$(".wrapper").addClass("toggled");
		if (isMobileViewport()) {
			showOverlay();
			_savedScrollY = window.scrollY;
			document.body.style.top = "-" + _savedScrollY + "px";
			document.body.classList.add("sidebar-open");
		}
	}

	// Tooltips
	$(function () {
		$('[data-bs-toggle="tooltip"]').tooltip();
	})

	// Legacy nav-toggle (if any)
	$(".nav-toggle-icon").on("click", function () {
		$(".wrapper").toggleClass("toggled")
	})

	// Active menu highlighting
	$(function () {
		for (var e = window.location, o = $(".metismenu li a").filter(function () {
			return this.href == e
		}).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
	})


	// Main sidebar toggle handler (unified — replaces conflicting handlers)
	// Note: localStorage is saved here because e.stopPropagation() blocks delegated handlers
	$(".toggle-icon").click(function (e) {
		e.stopPropagation();

		if ($(".wrapper").hasClass("toggled")) {
			closeSidebar();
		} else {
			openSidebar();
		}

		// Persist sidebar state
		var nowToggled = $(".wrapper").hasClass("toggled");
		if (isMobileViewport()) {
			localStorage.setItem('upos_sidebar_open', nowToggled ? 'true' : 'false');
		} else {
			localStorage.setItem('upos_sidebar_collapse', nowToggled ? 'true' : 'false');
		}
	})

	// Close sidebar when overlay is tapped/clicked (mobile/tablet)
	$(document).on("click touchstart", ".sidebar-overlay", function (e) {
		e.preventDefault();
		e.stopPropagation();
		closeSidebar();
		localStorage.setItem('upos_sidebar_open', 'false');
	});

	// Prevent background scroll when touching the overlay
	$(document).on("touchmove", ".sidebar-overlay", function (e) {
		e.preventDefault();
	});

	// Close sidebar on window resize crossing breakpoint
	var wasDesktop = !isMobileViewport();
	var resizeTimer;
	$(window).on("resize", function () {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function () {
			var isDesktop = !isMobileViewport();
			if (isDesktop && !wasDesktop) {
				// Went from mobile to desktop: close overlay, restore stored state
				hideOverlay();
				document.body.classList.remove("sidebar-open");
				document.body.style.top = "";
				$(".wrapper").removeClass("sidebar-hovered");
				if (localStorage.getItem("upos_sidebar_collapse") === "true") {
					$(".wrapper").addClass("toggled");
				} else {
					$(".wrapper").removeClass("toggled");
				}
			} else if (!isDesktop && wasDesktop) {
				// Went from desktop to mobile: close sidebar
				closeSidebar();
				localStorage.setItem('upos_sidebar_open', 'false');
			}
			wasDesktop = isDesktop;
		}, 150);
	});

	// On mobile, sidebar stays open when navigating via menu links
	// State is persisted in localStorage and restored on page load



	$(function () {
		$("#menu").metisMenu()
	})


	$(".search-toggle-icon").on("click", function () {
		$(".top-header .navbar form").addClass("full-searchbar")
	})
	$(".search-close-icon").on("click", function () {
		$(".top-header .navbar form").removeClass("full-searchbar")
	})


	$(".chat-toggle-btn").on("click", function () {
		$(".chat-wrapper").toggleClass("chat-toggled")
	}), $(".chat-toggle-btn-mobile").on("click", function () {
		$(".chat-wrapper").removeClass("chat-toggled")
	}), $(".email-toggle-btn").on("click", function () {
		$(".email-wrapper").toggleClass("email-toggled")
	}), $(".email-toggle-btn-mobile").on("click", function () {
		$(".email-wrapper").removeClass("email-toggled")
	}), $(".compose-mail-btn").on("click", function () {
		$(".compose-mail-popup").show()
	}), $(".compose-mail-close").on("click", function () {
		$(".compose-mail-popup").hide()
	})


	$(document).ready(function () {
		$(window).on("scroll", function () {
			$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
		}), $(".back-to-top").on("click", function () {
			return $("html, body").animate({
				scrollTop: 0
			}, 600), !1
		})
	})


	// switcher 

	// Dark mode toggle - uses addClass/removeClass to preserve existing classes
	// and persists preference in localStorage
	$(".dark-mode").on("click", function () {

		if ($("html").hasClass("dark-theme")) {
			$(".dark-mode-icon i").attr("class", "bi bi-moon-fill");
			$("html").removeClass("dark-theme light-theme semi-dark minimal-theme");
			localStorage.setItem("theme", "light");
		} else {
			$(".dark-mode-icon i").attr("class", "bi bi-brightness-high-fill");
			$("html").removeClass("light-theme semi-dark minimal-theme").addClass("dark-theme");
			localStorage.setItem("theme", "dark");
		}

	}),

		$("#LightTheme").on("click", function () {
			$("html").removeClass("dark-theme semi-dark minimal-theme").addClass("light-theme");
			localStorage.setItem("theme", "light");
		}),

		$("#DarkTheme").on("click", function () {
			$("html").removeClass("light-theme semi-dark minimal-theme").addClass("dark-theme");
			localStorage.setItem("theme", "dark");
		}),

		$("#SemiDarkTheme").on("click", function () {
			$("html").removeClass("dark-theme light-theme minimal-theme").addClass("semi-dark");
			localStorage.setItem("theme", "semi-dark");
		}),

		$("#MinimalTheme").on("click", function () {
			$("html").removeClass("dark-theme light-theme semi-dark").addClass("minimal-theme");
			localStorage.setItem("theme", "minimal");
		})


	$("#headercolor1").on("click", function () {
		$("html").addClass("color-header headercolor1"), $("html").removeClass("headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
	}), $("#headercolor2").on("click", function () {
		$("html").addClass("color-header headercolor2"), $("html").removeClass("headercolor1 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
	}), $("#headercolor3").on("click", function () {
		$("html").addClass("color-header headercolor3"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
	}), $("#headercolor4").on("click", function () {
		$("html").addClass("color-header headercolor4"), $("html").removeClass("headercolor1 headercolor2 headercolor3 headercolor5 headercolor6 headercolor7 headercolor8")
	}), $("#headercolor5").on("click", function () {
		$("html").addClass("color-header headercolor5"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor3 headercolor6 headercolor7 headercolor8")
	}), $("#headercolor6").on("click", function () {
		$("html").addClass("color-header headercolor6"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor3 headercolor7 headercolor8")
	}), $("#headercolor7").on("click", function () {
		$("html").addClass("color-header headercolor7"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor3 headercolor8")
	}), $("#headercolor8").on("click", function () {
		$("html").addClass("color-header headercolor8"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor3")
	})


	if (window.innerWidth > 1024) {
		if (document.querySelector(".header-message-list")) {
			new PerfectScrollbar(".header-message-list")
		}
		if (document.querySelector(".header-notifications-list")) {
			new PerfectScrollbar(".header-notifications-list")
		}
	}



});