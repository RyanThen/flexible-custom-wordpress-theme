import $ from 'jquery';

class Search {
	// 1. Initiate object
	constructor() {
		this.openButton = $(".js-search-trigger");
		this.closeButton = $(".search-overlay__close");
		this.searchOverlay = $(".search-overlay");
		this.searchField = $("#search-term");
		this.typingTimer;
		this.isOpen = false;
		this.events();
	}

	// 2. Events
	events() {
		this.openButton.on("click", this.openOverlay.bind(this));
		this.closeButton.on("click", this.closeOverlay.bind(this));
		$(document).on("keydown", this.keyPressDispatcher.bind(this));
		this.searchField.on("keydown", this.typingLogic.bind(this));
	}

	// 3. Methods
	typingLogic() {
		clearTimeout(this.typingTimer);
		this.typingTimer = setTimeout(function(){alert("hey now brown cow!")}, 2000);
	}

	keyPressDispatcher(e) {
		if(e.keyCode === 83 && !this.isOpen) {
			this.openOverlay();
			this.isOpen = true;
		}
		if(e.keyCode === 27 && this.isOpen) {
			this.closeOverlay();
			this.isOpen = false;
		}
	}

	openOverlay() {
		this.searchOverlay.addClass('search-overlay--active');
		$('body').addClass('body-no-scroll');
	}

	closeOverlay(){
		this.searchOverlay.removeClass('search-overlay--active');
		$('body').removeClass('body-no-scroll');
	}
}

export default Search;