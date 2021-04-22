class formView {

    constructor() {

        this.formValues = [];
    }

    initGUIEvents() {
        let self = this;

        $('#submit-form').on("click", function () {
            self.getFormData();
            if (self.hasValues()) {
                self.displayOutput();
            } else {
                self.displayError();
            }
        });
    }

    getFormData() {
        this.formValues = [];

        if ($('input[name="firstname"]').val()) {
            this.formValues["firstname"] = $('input[name="firstname"]').val();
        }
        if ($('input[name="lastname"]').val()) {
            this.formValues["lastname"] = $('input[name="lastname"]').val();
        }
        if ($('input[name="birthdate"]').val()) {
            this.formValues["birthdate"] = $('input[name="birthdate"]').val();
        }
        if ($('select[name="sex"]').val() != "-1") {
            this.formValues["sex"] = $('select[name="sex"]').val() == 1 ? "weiblich" : "m&auml;nnlich";
        }
    }

    hasValues() {
        let i = 0;
        for (var x in this.formValues) {
            i++;
        }

        if (i == 4) {
            return true;
        } else {
            return false;
        }
    }

    displayOutput() {
        let outputString = this.formValues["firstname"] + " " + this.formValues["lastname"] + " wurde " + this.formValues["birthdate"] + " geboren und ist " + this.formValues["sex"] + ".";
        $('#output').html(outputString);
    }

    displayError() {
        let outputString = "Fehler! <br />";

        $('input, select').each(function () {
            if (!$(this).val() || $(this).val() == -1) {
                outputString += "- Feld " + $(this).attr("name") + " muss noch ausgef&uuml;llt werden. <br />";
            }
        });


        $('#output').html(outputString);
    }
}
