import $ from 'jquery';

class MyNotes {
	constructor(){
		this.events();
	}

	//Events
	events() {
		$(".delete-note").on("click", this.deleteNote);
	}

	//Methods
	deleteNote() {
		alert('test message');
	}
}

export default MyNotes;