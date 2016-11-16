function identifyUserAgent(){
    var $ = jQuery;
    var userAgent =  navigator.userAgent;
    

    var browsername = 'uknown-browser';
    if(true == /Firefox/.test(userAgent))
            browsername = 'firefox';
    if(true == /Safari/.test(userAgent))
            browsername = 'safari';
    if(true == /Chrome/.test(userAgent))
            browsername = 'chrome';
    if(true == /MSIE/.test(userAgent))
            browsername = 'ie';
    if(true == /Windows NT/.test(userAgent))
            browsername = 'ie';    
    if(true == /MSIE 6.0/.test(userAgent))
            browsername = 'ie6';
    if(true == /MSIE 7.0/.test(userAgent))
            browsername = 'ie7';
    if(true == /MSIE 8.0/.test(userAgent))
            browsername = 'ie8';
    if(true == /MSIE 9.0/.test(userAgent))
            browsername = 'ie9';
    $('body').addClass(browsername);

    var osname = 'uknown-os';
    switch(true){
        case /Windows/.test(userAgent):
            osname = 'windows';
        break; 
        case /Mac/.test(userAgent):
            osname = 'mac';
        break; 
        case /Linux/.test(userAgent):
            osname = 'linux';
        break; 
    }        
    $('body').addClass(osname);

    var typename = 'computer';
    switch(true){
        case /iPad/.test(userAgent):
            typename = 'ipad';
        break; 
        case /iPhone/.test(userAgent):
            typename = 'iphone';
        break; 
        case /Android/.test(userAgent):
            typename = 'android';
        break; 
    }        
    $('body').addClass(typename);        
}