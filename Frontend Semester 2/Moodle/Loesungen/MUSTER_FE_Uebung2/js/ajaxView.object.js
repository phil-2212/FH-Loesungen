class ajaxView{
    constructor()
    {
        this.$table = $('#output-table');
    }

    initGUIEvents(){
        let self = this;

        $('#trigger-request').on("click", function(){
            self.getAjaxRequest();
        });
    }

    getAjaxRequest(){
        let self = this;
    
        $.ajax({
            url: "https://httpbin.org/get",
            method: "GET",
        
            success: function(response){
                self.resetTable();
                self.fillTable(response);
            },
            error: function(error){
              self.displayError(error);
            }
        });   
    }

    resetTable(){
        this.$table.find("tbody").empty();
    }


    fillTable(data){
        for(let key in data){
            
            if(typeof data[key] != "object"){
                this.fillRow(key, data[key]);
            } else {
                this.fillTable(data[key]);
            }
        }
    }

    fillRow(key, value){
        let $row = $('<tr></tr>');
        $row.append("<td>"+key+"</td><td>"+value+"</td>");
        
        this.$table.find("tbody").append($row);
        
    }

    displayError(error){
        console.log(error);
    }
}
