class ListView {

  constructor() {
    this.view = [];
  }

  setView(view) {
    this.view = view;
  }

  createTableOutput() {

    for(let i = 2; i < this.view.length; i++) {

      let index = this.view;

      $("#list-output").append(`<li>${this.view[i+1]}</li>`);
      i++;

    }

    $("#list-output").addClass("filled");

    // show info about loop in result box
    $("#result-info").append(`Loop name: ${this.view[1]}`);
  }
}

export { ListView };
