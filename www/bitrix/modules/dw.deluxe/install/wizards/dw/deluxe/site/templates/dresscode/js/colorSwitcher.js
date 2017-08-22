$(function(){
	$("#colorSwitcher .items .item a").on("click", function(){
		$("#colorSwitcher .item").removeClass("selected").find("a").removeClass("loading");
		var $this = $(this).addClass("loading");
		$this.parent().addClass("selected");
		var date = new Date(new Date().getTime() + 600 * 1000);
		document.cookie = "TEMPLATE_THEME_NAME=" + $this.data("color-name") + "; path=/; expires=" + date.toUTCString();
		location.reload();
		$(".colorSwitcherLoader").fadeIn("slow").addClass("visible");
		return event.preventDefault();
	});

	$("#colorSwitcher .backgroundItems .item a").on("click", function(){
		$("#colorSwitcher .backgroundItems .item").removeClass("selected").find("a").removeClass("loading");
		var $this = $(this).addClass("loading");
		$this.parent().addClass("selected");
		var date = new Date(new Date().getTime() + 600 * 1000);
		document.cookie = "TEMPLATE_BACKGROUND_NAME=" + $this.data("color-name") + "; path=/; expires=" + date.toUTCString();
		location.reload();
		$(".colorSwitcherLoader").fadeIn("slow").addClass("visible");
		return event.preventDefault();
	});

	var changeTemplateVersion = function(event){
		var $this = $(this);
		window.location.href = $this.val();
	};

	$(document).on("change", "#switcherMenuSelect", changeTemplateVersion);
});

$(function(){

	var changeSwitcherOptions = function(event){

		var $this = $(this);
		var currentValue = $this.val();

		var date = new Date(new Date().getTime() + 6000 * 1000);
		document.cookie = $this.data("id") + "=" + currentValue + "; path=/; expires=" + date.toUTCString();
		$(".colorSwitcherLoader").fadeIn("slow").addClass("visible");
		location.reload();

		return event.preventDefault();

	};

	var changeSwitcherTheme = function(event){
		var $this = $(this);
		var currentValue = $this.data("color-name");

		var date = new Date(new Date().getTime() + 6000 * 1000);
		document.cookie = "TEMPLATE_THEME_NAME=" + currentValue + "; path=/; expires=" + date.toUTCString();
		$(".colorSwitcherLoader").fadeIn("slow").addClass("visible");
		location.reload();

		return event.preventDefault();
	};

	var changeSwitcherBackground = function(event){

		var $this = $(this);
		var currentValue = $this.data("color-name");

		var date = new Date(new Date().getTime() + 6000 * 1000);
		document.cookie = "TEMPLATE_BACKGROUND_NAME=" + currentValue + "; path=/; expires=" + date.toUTCString();
		$(".colorSwitcherLoader").fadeIn("slow").addClass("visible");
		location.reload();

		return event.preventDefault();
	};

	var switcherClear = function(event){

		$(".colorSwitcherLoader").fadeIn("slow").addClass("visible");

		var date = new Date(new Date().getTime() + 6000 * 1000);
		document.cookie = "TEMPLATE_HEADER=header1; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_HEADER_TYPE=type1; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_HEADER_COLOR=default; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_SUBHEADER_COLOR=default; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_PANELS_COLOR=default; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_FOOTER_LINE_COLOR=default; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_FOOTER_VARIANT=default; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_THEME_NAME=default; path=/; expires=" + date.toUTCString();
		document.cookie = "TEMPLATE_BACKGROUND_NAME=white; path=/; expires=" + date.toUTCString();
		location.reload();

		return event.preventDefault();
	};

	var openSwitcher = function(event){

		var $templateSwitcher = $(".templateSwitcher");
		var $this = $(this);

		if($templateSwitcher.hasClass("opened")){
			$templateSwitcher.removeClass("opened");
			$this.removeClass("active");
		}else{
			$templateSwitcher.addClass("opened");
			$this.addClass("active");
		}

		return event.preventDefault();

	};

	var closeSwitcher = function(event){

		var $templateSwitcher = $(".templateSwitcher");
		var $templateSwitcherSettings = $(".templateSwitcherSettings");

		$templateSwitcher.removeClass("opened");
		$templateSwitcherSettings.removeClass("active");

		return event.preventDefault();

	}

	$(document).on("change", ".switcherSelect", changeSwitcherOptions);
	$(document).on("click", ".switcherBackgroundItem a", changeSwitcherBackground);
	$(document).on("click", ".switcherThemesItem a", changeSwitcherTheme);
	$(document).on("click", ".switcherClear", switcherClear);
	$(document).on("click", ".templateSwitcherSettings", openSwitcher);
	$(document).on("click", ".switcherClose", closeSwitcher);

});