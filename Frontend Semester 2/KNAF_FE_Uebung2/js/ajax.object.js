class Ajax {


    constructor(){
    }
    
    initAjax(){
        
        let self = this;

        $('#test').on("click", function () {
            self.callAjax();
        });
    }
        

    callAjax(){

        let self = this;

        $.ajax({
            url: 'http://httpbin.org/get?firstname=Herbert&lastname=Knaf',
            method: 'GET',
            dataType: 'JSON',
            success: function(response){
            
            
          var table = $('<table/>').html('<thead><tr><th>KEY:</th><th>VALUE:</th></tr></thead>').appendTo('body');
          self.parseToTable(response, table.append('<tbody/>'));


            },
            error: function(error){
            $('#output').html(error);
            alert (error);
            }
            });

    }

    parseToTable(obj, el){

        let self = this;

        $.each(obj, function(key, value){
            

            var keyType = ($.isPlainObject(value) ? '{'+key+'}' : ($.isArray(value) ? '['+key+']' : key));
            var tr = $('<tr/>').html('<td>'+keyType+' :</td>').appendTo(el);
            if($.isPlainObject(value) || $.isArray(value)){
               
                self.parseToTable(value, $('<table/>').html('<thead><tr><th>KEY:</th><th>VALUE:</th></tr></thead>').appendTo(tr));
           
            }else{

                tr.append('<td>'+value+'</td>');
            }
        });
    }



}