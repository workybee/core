function pointHover(id) {
    var point = document.getElementById(id);
    var cx = point.getAttribute('x');
    var cy = point.getAttribute('y');
    console.log('Point '+id+' ( '+cx+' , '+cy+' )');
    var scale = 2;
    cx = cx-scale*cx;
    cy = cy-scale*cy;
    point.setAttribute("transform", 'matrix('+scale+', 0, 0, '+scale+', '+cx+', '+cy+')');
    var tooltip = document.getElementById(id+'-tooltip');
    tooltip.setAttribute("visibility", 'visible');
    setTimeout(function(){
        var point = document.getElementById(id);
        point.removeAttribute("transform", '');
        var tooltip = document.getElementById(id+'-tooltip');
        tooltip.setAttribute("visibility", 'hidden');
    }, 1000);
}
