class ListView {
  constructor() {
    this.view = [];
  }

  setView(view) {
    this.view = view;
  }

  createTableOutput() {

    $('#list-output').empty();
    $('#result-info').empty();

    for (let i = 2; i < this.view.length; i++) {
      // TODO: Change the view to an object instead of an array
      $('#list-output').append(`<li>${this.view[i + 1]}</li>`);
      i++;
    }

    // TODO: Change the view to an object instead of an array
    $('#result-info').append(`Loop name: ${this.view[1]}`);
  }
}

export { ListView };
