

function allowDrop(ev)
{
    ev.preventDefault();
}

function drag(ev)
{
    alert(ev.target.id); //ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev)
{
    ev.preventDefault();
    var data=ev.dataTransfer.getData("Text");
    alert(data);
    
}