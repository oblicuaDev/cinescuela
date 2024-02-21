//Javascript SDK for Oreka API v0.1

/**
 * O Object creates a unique Brand connection to Oreka. It can be created on Testing or production environment.
 *
 * @class O
 * @constructor
 * @param {String} Access Token. Connection token. You should have a token per Oreka Application you build. Get mor info about Access tokens on www.orekacloud.com/tokens
 * @param {Boolean} environment. This param set your envorinoment preference. 0 for Production. 1 for Testing environment.
 * @param {Boolean} b64. Turn b64 param ON if you want to get results including base64 encoding on Files and images fields. Your queries will be slower.
 */


function O(AccessToken,environment=0,b64=0)
{
    this.environmentSet = environment;
    this.token = AccessToken;
    this.ACCESS_POINT = 'http://orekacloud.com/api/public/';
    this.headers = {
                "access-token":AccessToken,
                "environment-set":this.environmentSet,
                "content-type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers"
              }
   if(b64==1){
       this.headers = {
                "access-token":AccessToken,
                "enable-b64":b64,
                "environment-set":this.environmentSet,
                "content-type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers"
              }
   } 
  
    this.result = '';
    
    /**
    * Get a basic rows collection based on specific modules and sorting parametters.
    * @method getCollection
    * @param {Number} Numeric Module ID
    * @param {String} orderby Sorting mode. Options: "code", "gord", "lord"
    * @param {String} orientation ASC or DESC complementary order. Options: "downward" for desc, "upward" for asc
    * @param {Number} quantity Number of rows requested.
    * @param {Number} page Custom query offset for pagination actions. This value is a positive int value.
    * @param {Function} orekaCallback Custom callback action executed when function get results from Oreka. It can be a previously declared function or an anonymous function.
    */
    this.getCollection = function(module,orderby,orientation,quantity,page,orekaCallback){
        
        var theURL = this.ACCESS_POINT+"v1/collection/"+module+"/"+orderby+"/"+orientation+"/"+quantity+"/"+page;
     
        var myResponse = "Empty Object";
        
        var settings = {
              async: true,
              crossDomain: true,
              url: theURL,
              method: "GET",
              headers: this.headers,
              processData: true,
              //jsonp:true,
              xhrFields:{ withCredentials:false },
              data:{ },
              complete:orekaCallback
            }
            $.ajax(settings);
        
    }
    
    
    /**
    * Check the connection status with a specific Oreka Brand.
    * @method helloworld
    * @param {Function} orekaCallback Custom callback action executed when function get results from Oreka. It can be a previously declared function or an anonymous function.
    */
    
    this.helloworld = function(orekaCallback){ 
    var theURL = this.ACCESS_POINT+"v1/hello";
     
        var myResponse = "Empty Object";
        
        var settings = {
              async: true,
              crossDomain: true,
              url: theURL,
              method: "GET",
              headers: this.headers,
              processData: true,
              //jsonp:true,
              xhrFields:{ withCredentials:false },
              data:{ },
              complete:orekaCallback
            }
            $.ajax(settings);
    }

    /**
    * Get a rows collection based on custom searches.
    * @method fieldSearch
    * @param {Number/String} value Numeric or String searched value
    * @param {Number} field Numeric Field ID
    * @param {number} type Integer value for field type. 1 for char, 
    * @param {Number} quantity Number of rows requested.
    * @param {Number} page Custom query offset for pagination actions. This value is a positive int value.
    * @param {String} sort Sorting mode. Options: "code", "gord", "lord"
    * @param {String} orientation ASC or DESC complementary order. Options: "downward" for desc, "upward" for asc
    * @param {Function} orekaCallback  Custom callback action executed when function get results from Oreka. It can be a previously declared function or an anonymous function.
    */   
    this.fieldSearch = function(value,field,type,quantity,page,sort,orientation,orekaCallback){
       
        var theURL = this.ACCESS_POINT+"v1/dev-searches/"+value+"/"+field+"/"+type+"/"+quantity+"/"+page+"/"+sort+"/"+orientation;
     
        var myResponse = "Empty Object";
        
        var settings = {
              async: true,
              crossDomain: true,
              url: theURL,
              method: "GET",
              headers: this.headers,
              processData: true,
              //jsonp:true,
              xhrFields:{ withCredentials:false },
              data:{ },
              complete:orekaCallback
            }
            $.ajax(settings);
    }
    
    /**
    * Get single rows or a group of rows with basic ROW ID requests.
    * @method getRows
    * @param {Number/Array} Row IDs group (in array) or single Row ID (Integer).
    * @param {Function} orekaCallback  Custom callback action executed when function get results from Oreka. It can be a previously declared function or an anonymous function.
    */ 
    this.getRows = function(rowId,orekaCallback,as=true){
       
        var theURL = this.ACCESS_POINT+"v1/rows/"+rowId;
     
        var myResponse = "Empty Object";
        
        var settings = {
              async: as,
              crossDomain: true,
              url: theURL,
              method: "GET",
              headers: this.headers,
              processData: true,
              //jsonp:true,
              xhrFields:{ withCredentials:false },
              data:{ },
              complete:orekaCallback
            }
            return $.ajax(settings);
    }
    
    
    /**
    * Destroy current Brand Connections.
    * @method destroy
    * @param {Function} orekaCallback  Custom callback action executed when function get results from Oreka. It can be a previously declared function or an anonymous function.
    */ 
    this.destroy = function(orekaCallback){
       
        var theURL = this.ACCESS_POINT+"destroy";
     
        var myResponse = "Empty Object";
        
        var settings = {
              async: true,
              crossDomain: true,
              url: theURL,
              method: "GET",
              headers: this.headers,
              processData: true,
              //jsonp:true,
              xhrFields:{ withCredentials:false },
              data:{ },
              complete:orekaCallback
            }
            $.ajax(settings);
    }
    
    /**
    * Get rows count on module
    * @method countRows
    * @param {Number} module Numeric module ID
    * @param {Function} orekaCallback  Custom callback action executed when function get results from Oreka. It can be a previously declared function or an anonymous function.
    */ 
    this.countRows = function(module, orekaCallback){
       
        var theURL = this.ACCESS_POINT+"v1/count_re/"+module;
     
        var myResponse = "Empty Object";
        
        var settings = {
              async: true,
              crossDomain: true,
              url: theURL,
              method: "GET",
              headers: this.headers,
              processData: true,
              //jsonp:true,
              xhrFields:{ withCredentials:false },
              data:{ },
              complete:orekaCallback
            }
            $.ajax(settings);
    }

    /**
    * Get rows count on module
    * @method countRows
    * @param {Number} module Numeric module ID
    * @param {Function} orekaCallback  Custom callback action executed when function get results from Oreka. It can be a previously declared function or an anonymous function.
    */ 
    this.postRow = function(modules, rows, idfies, types, values, orekaCallback){
        var theURL = this.ACCESS_POINT+"v1/create";
     
        var iRows=0;
        var body={};
        var data={};
        if(!$.isArray(modules)){
            modules=[modules];
            rows=[rows];
            idfies=[idfies];
            var ntypes=types.split(",").length;
            types=[types];
            var nvalues=values.length;
            if(ntypes==nvalues)
                values=[[values]];
        }
        for (var i = modules.length - 1; i >= 0; i--) {
            var currFies=idfies[i].split(",");
            var currTypes=types[i].split(",");
            for (var j = 0; j < rows[i]; j++) {
                data["newrow"+iRows]={module:modules[i],
                                      values:{},
                                      idfields:{},
                                      typefields:{},
                                      types:""};
                for (var k = 0; k < currFies.length; k++) {
                    data["newrow"+iRows].values["val"+k]=values[i][j][k];
                    data["newrow"+iRows].idfields["id"+k]=currFies[k];
                    data["newrow"+iRows].typefields["type"+k]=currTypes[k];
                }
                iRows++;
            }
        }
        body.data=data;
        var myJson=JSON.stringify(body);
        console.log(myJson);

        var settings = {
              async: true,
              crossDomain: true,
              url: theURL,
              type: "POST",
              headers: this.headers,
              processData: false,
              //jsonp:true,
              xhrFields:{ withCredentials:false },
              data: myJson,
              complete:orekaCallback
            }
            $.ajax(settings);
    }
    this.editRow = function(body,orekaCallback){
    
      var theURL = this.ACCESS_POINT+"v1/edit";

      var myResponse = "Empty Object";
  
      var settings={
          async:true,
          crossDomain:true,
          url:theURL,
          type:"PUT",
          headers:this.headers,
          processData:false,
          xhrFields:{withCredentials:false},
          data:JSON.stringify(body),
          complete:orekaCallback
      };
      return $.ajax(settings);
    }
    this.sendNotification=function(from,to,toname,mergevariables,subject,template,mandrillApiKey,fromName="Oreka Notifications Service",orekaCallback){
      var url=this.ACCESS_POINT+"v1/notifications";
      var body={
        "from":from,
        "to":to,
        "toname":toname,
        "subject":subject,
        "template":template,
        "mandrillapikey":mandrillApiKey,
        "sender":fromName
      };
      var merged={};
      for(var i=0;i<mergevariables.length;i++){
          merged["pos"+i]=mergevariables[i];
      }
      body.mergevariables=merged;
      var settings={
        async:true,
        crossDomain:true,
        url:url,
        type:"POST",
        headers:this.headers,
        processData:false,
        xhrFields:{withCredentials:false},
        data:JSON.stringify(body),
        complete:orekaCallback
      };
      $.ajax(settings);
    }
}