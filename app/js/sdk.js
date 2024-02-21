//Javascript SDK for Oreka API v0.1

           


function O(AccessToken,environment=0,b64=0)
{
    this.environmentSet = environment;
    this.token = AccessToken;
    this.headers = {
                "access-token":AccessToken,
                "content-type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers"
              }
   if(b64==1){
       this.headers = {
                "access-token":AccessToken,
                "enable-b64":b64,
                "content-type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers"
              }
   } 
  
    this.result = '';
    this.getCollection = function(module,orderby,orientation,quantity,page,orekaCallback){
        
        var theURL = "https://orekacloud.com/public/v1/collection/"+module+"/"+orderby+"/"+orientation+"/"+quantity+"/"+page;
     
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
    
    this.helloworld = function(orekaCallback){ 
    var theURL = "https://orekacloud.com/public/v1/hello";
     
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
    
    this.fieldSearch = function(value,field,type,quantity,page,sort,orientation,orekaCallback){
       
        var theURL = "https://orekacloud.com/public/v1/dev-searches/"+value+"/"+field+"/"+type+"/"+quantity+"/"+page+"/"+sort+"/"+orientation;
     
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
    
    this.getContent = function(rowId,orekaCallback){
       
        var theURL = "https://orekacloud.com/public/v1/rows/"+rowId;
     
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
    
    this.destroy = function(orekaCallback){
       
        var theURL = "https://orekacloud.com/public/destroy";
     
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
    
    this.count_re = function(module, orekaCallback){
       
        var theURL = "https://www.orekacloud.com/public/v1/count_re/"+module;
     
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
    }