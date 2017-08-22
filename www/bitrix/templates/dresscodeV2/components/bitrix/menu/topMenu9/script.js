$(function(){

	var $sliceMenu = $("#subMenu");
	var $sliceMenuItems = $sliceMenu.children("li");

	var sliceMenuOpened = false;

	var sliceMenuOnline = function(resize){

		if(resize == true){

			$sliceMenu.find(".removed").each(function(i, nextElement){
				var $nextElement = $(nextElement);
				$sliceMenu.append(
					$nextElement.removeClass("removed")
				)
			});

			$sliceMenu.find(".removedItemsContainer").remove();

		}else{
			$sliceMenu.css("visibility", "visible");
		}

		var menuMaxWidth = $("#subHeader9 .subHeaderMenu2").width();
		var sumMenuItemsWidth = 70;

		if(window.innerWidth <= 1021){
			menuMaxWidth = 0;
		}

		$sliceMenuItems.each(function(i, nextElement){

			var $nextElement = $(nextElement);
				sumMenuItemsWidth += $nextElement.width();

			if(sumMenuItemsWidth >= menuMaxWidth){
				$nextElement.addClass("removed");
			}

		});

		//create drop down
		var $removedItems = $sliceMenu.find(".removed");

		if($removedItems.length > 0){

			var $removedItemsList = $("<ul/>").addClass("removedItemsList");
			var $removedItemsLink = $("<li/>").addClass("removedItemsContainer").append($("<a/>", {class: "removedItemsLink"}).attr("href", "#"));

			$removedItems.each(function(i, nextElement){
				var $nextElement = $(nextElement);
				$removedItemsList.append($nextElement);
			});

			$sliceMenu.append($removedItemsLink.append($removedItemsList));

		}

	}

	var openDropDownMenu = function(event){

		if(sliceMenuOpened == false){
			$("#subMenu .removedItemsList").show();
			sliceMenuOpened = true;
		}else{
			$("#subMenu .removedItemsList").hide();
			sliceMenuOpened = false;
		}

		return event.preventDefault();
	}

	var closeDropDownMenu = function(event){
		$("#subMenu .removedItemsList").hide();
		sliceMenuOpened = false;
	};

	$(document).on("click", "#subHeader9 #subMenu .removedItemsLink", openDropDownMenu);
    $(document).on("click", "#subHeader9 #subMenu .removedItemsList, .removedItemsLink", function(event){
    	return event.stopImmediatePropagation();
    });

	$(document).on("click", closeDropDownMenu);

	$(document).on("ready", function(){
		sliceMenuOnline(false);
	});

	$(window).on("resize", function(){
		sliceMenuOnline(true);
	});

});