import $ from 'jquery';

class Search {
	// 1. Initiate object
	constructor() {
		this.openButton = $(".js-search-trigger");
		this.closeButton = $(".search-overlay__close");
		this.searchOverlay = $(".search-overlay");
		this.searchField = $("#search-term");
		this.resultsDiv = $("#search-overlay__results");
		this.typingTimer;
		this.isOpen = false;
		this.isSpinnerVisible = false;
		this.previousValue;
		this.events();
	}

	// 2. Events
	events() {
		this.openButton.on("click", this.openOverlay.bind(this));
		this.closeButton.on("click", this.closeOverlay.bind(this));
		$(document).on("keydown", this.keyPressDispatcher.bind(this));
		this.searchField.on("keyup", this.typingLogic.bind(this));
	}

	// 3. Methods
	typingLogic() {
			if(this.searchField.val() != this.previousValue) {
				clearTimeout( this.typingTimer );

				if ( this.searchField.val() ) {
					if ( !this.isSpinnerVisible ) {
						this.resultsDiv.html( '<div class="spinner-loader"></div>' );
						this.isSpinnerVisible = true;
					}
					this.typingTimer = setTimeout( this.getResults.bind( this ), 2000 );
				} else {
					this.resultsDiv.html( '' );
					this.isSpinnerVisible = false;
				}
			}
		this.previousValue = this.searchField.val();
	}

	getResults() {
		$.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
			this.resultsDiv.html( `
				<h2 class="search-overlay__section-title">General Information</h2>
				${ posts.length ? `<ul class="link-list min-list">` : `<h4>No information matches your search term</h4>` }
				${ posts.map( item => `<li><a href="${item.link}">${item.title.rendered}</a></li>` ).join( '' )}
				${ posts.length ? `</ul>` : '' }
			` );
			this.isSpinnerVisible = false;
		});
	}

	keyPressDispatcher(e) {
		if(e.keyCode === 83 && !this.isOpen && !$("input, textarea").is(":focus")) {
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