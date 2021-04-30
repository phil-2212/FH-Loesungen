class AjaxLoopView{

    initGUIEvents(){

        let self = this;

        self.toggleForWhile();
        self.buttonLockOnEmptyInput();

        $('#trigger-request').on("click", function(){
            self.getAjaxRequest();
        });
    }

    toggleForWhile(){

        $('#loopType').on('change', function() {
            if ( this.value === 'until')

            {
                $("#trigger-request").attr("disabled", true);
                $("#toggle-input-while").show();
            }
            else {
                $("#toggle-input-while").hide();
                $("#trigger-request").attr("disabled", false);
            }
        });
    }

    buttonLockOnEmptyInput() {

        $('#input-while').keyup(function () {

            let empty = false;
            $('#input-while').each(function () {
                if (this.value.length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('#trigger-request').attr('disabled', true);

            } else {
                $('#trigger-request').attr('disabled', false);
            }
        });

    }

    getLoopInput(){

        let loopType =  $('#loopType').val();
        let untilCharacter = $('#input-while').val();

        if (loopType === "until") {
            return loopType + "&until=" + untilCharacter;
        }
        else
        {
            return loopType;
        }
    }

    getAjaxRequest(){

        let self = this;
        let stringUrl = "./php/index.php?loopType=" + this.getLoopInput();

        $.ajax({
            url: stringUrl ,
            method: "GET"
             })
               .done( function(response){

                self.resetList();
                self.LoopView(response);
            })

                .fail( function(error){

                alert ("Something went wrong");
            });
    }

    resetList(){

        $('#loopView-output').empty();
    }

    LoopView(obj){

        $.each(obj, function(key, value) {
            $('#loopView-output').append('<ul class="ul-key">' + key + '</ul>');
            $('#loopView-output').append('<ul class="ul-result">' + value + '</ul>');
        });
    }
}
