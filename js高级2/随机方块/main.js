//生成10个方块  随机生成颜色
var container=document.getElementById("container");
var array=[];
for(var i=0;i<10;i++){
    var r=Tools.getRandom(0,255);
    var g=Tools.getRandom(0,255);
    var b=Tools.getRandom(0,255);
    var box=new Box(container,{
        backgroudColor:"rgb("+r+","+g+","+b+")"
    });
    //把创建好的方块对象，添加到数组
    array.push(box);
}
function show(){
    for(var i=0;i<array.length;i++){
        array[i].random();
    }
}
show();
setInterval (show,500);
