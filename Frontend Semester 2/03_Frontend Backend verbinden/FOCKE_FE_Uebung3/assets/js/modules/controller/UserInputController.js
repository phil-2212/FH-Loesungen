class UserInputController {
  constructor() {
    this.getParameters = [];
  }

  // This method collects all inputs from the user and pushes them into an array which then gets formatted to be put into a get method
  collectUserInputs () {

    // Save all user inputs into an array
    const userInputs = document.querySelectorAll(".getValue");

    // log all input "key-value" pairs
    for (let i = 0; i < userInputs.length; i++) {

      this.getParameters.push(`${userInputs[i].id}=${userInputs[i].value}`);

    }

    // This returns all values for the php file
    return (this.getParameters.join('&'));


  }
}

export { UserInputController };
