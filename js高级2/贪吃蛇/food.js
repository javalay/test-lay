function Food(options){//创建食物的构造函数
    options=options||{};//如果传的有参数就取options 如果没有就取空
    this.x=options.x||0;
    this.y=options.y||0;

    this.width=options.width||20;
    this.height=options.height||20;

    this.color=options.color||"green";
    this.map=map;
}
var position="absolute";
var elements=[];//原来储存div对象的
// 食物渲染到地图里面
Food.prototype.rander=function(map){
    remove();//每一次渲染过后就删除
    var div=document.createElement("div");//创建食物的div
    elements.push(div);//把div添加到elements数组中去
    this.map.appendChild(div);//把div添加到map中去
    //获取随机生成x的位置----利用公式算出来
    this.x=Tools.getRandom(0,this.map.offsetWidth/this.width-1)*this.width;
    this.y=Tools.getRandom(0,this.map.offsetHeight/this.height-1)*this.height;

    //给div添加一些style的属性
    div.style.position=position;
    div.style.left=this.x+"px";
    div.style.top=this.y+"px"; 
    div.style.width=this.width+"px";
    div.style.height=this.height+"px";
    div.style.backgroundColor=this.color;
}
//删除--从后面往前删除
function remove(){
    for(var i=elements.length-1;i>=0;i--){
        // 删除div
        elements[i].parentNode.removeChild(elements[i]);
        //删除数组中的元素
        //第一个参数，从哪个元素开始删除
        //第二个参数删除几个元素
        elements.splice(i,1);
    }
}
// var map=document.getElementById("map");
// var food=new Food(map);
// food.rander();
// food.rander();
// food.rander();
// food.rander();