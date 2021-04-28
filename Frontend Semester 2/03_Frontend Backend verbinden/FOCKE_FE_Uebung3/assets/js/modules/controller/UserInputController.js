class UserInputController {
  constructor() {
    this.getParameters = [];
  }

  /* This method collects all inputs from the user and pushes them
  into an array which then gets formatted to be put into a get method */
  collectUserInputs () {
    const userInputs = document.querySelectorAll('.getValue');

    for (let i = 0; i < userInputs.length; i++) {
      this.getParameters.push(`${userInputs[i].id}=${userInputs[i].value}`);
    }

    // key-value pairs php-ready
    return (this.getParameters.join('&'));
  }
}

export { UserInputController };
