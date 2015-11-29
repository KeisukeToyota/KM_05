function $( e ){
    return document.getElementById( e )
}

window.onload = function(){
    
    var container = $( 'container' )
    var login_page = $( 'login-background' )
    
    var signin = $('signin')
    signin.addEventListener( 'click', function(){
        
        container.className = 'blurin'
        login_page.style.display = 'block'
        login_page.className = 'fadein'
        
    }, false )
    
    var signin = $('close')
    signin.addEventListener( 'click', function(){
        
        container.className = 'blurout'
        login_page.className = 'fadeout'
        setTimeout(function(){ ogin_page.style.display = 'block' }, 15000)
        
    }, false )
    
}