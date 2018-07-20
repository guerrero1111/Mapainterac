   $(document).ready(function(){
$("#btndivisas").click(function() {
     $('#divisas').animate({
            right: "10"
        }, 500);
        
});
    
$("#divisas").click(function() {
     $('#divisas').animate({
            right: "-300"
        }, 500);
        
});

$("#divisas").mouseleave(function() {
     $('#divisas').animate({
            right: "-300"
        }, 500);
        
});




      });