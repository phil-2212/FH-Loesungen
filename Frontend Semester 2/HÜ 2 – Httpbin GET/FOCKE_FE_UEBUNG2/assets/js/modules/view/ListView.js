class ListView {

  constructor() {
    this.view = [];
  }

  setView(view) {
    this.view = view;
  }

  createTableOutput() {

    for(let i = 0; i < this.view.length; i++) {

      let index = this.view;

      $("tbody").append(`<tr><td>${this.view[i]}</td><td>${this.view[i+1]}</td></tr>`);
      i++;

    }
  }
}

export { ListView };
