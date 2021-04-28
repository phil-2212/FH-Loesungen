class ListView {
  constructor() {
    this.view = [];
  }

  setView(view) {
    this.view = view;
  }

  createTableOutput() {
    for (let i = 2; i < this.view.length; i++) {
      // TODO: Change the view to an object instead of an array
      $('#list-output').append(`<li>${this.view[i + 1]}</li>`);
      i++;
    }

    // TODO: I am also not completely content with this
    $('#list-output').addClass('filled');

    // TODO: Change the view to an object instead of an array
    $('#result-info').append(`Loop name: ${this.view[1]}`);
  }

  prepareOutputField() {
    if ($('#list-output').is('.filled')) {
      $('#list-output').empty();
      $('#result-info').empty();
    }
  }
}

export { ListView };
