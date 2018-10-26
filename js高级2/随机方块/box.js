function Box(parent,options){
    options=options||{};
    //设置对象的属性
    this.backgroudColor=options.backgroudColor||"red";
    this.width=options.width||20;
    this.height=options.height||20;
    this.x=options.x||0;
    this.y=options.y||0;
    //创建对于的div
    this.div=document.createElement("div");
    this.parent=parent;
    parent.appendChild(this.div);
    this.init();
}
//初始化div（方块）样式
Box.prototype.init=function(){
    // this.div.style.
    var div=this.div;
    div.style.backgroundColor=this.backgroudColor;
    div.style.width=this.width+"px";
    div.style.height=this.height+"px";
    div.style.left=this.left+"px";
    div.style.right=this.right+"px";
    //脱离文档流
    div.style.position="absolute"
}
//原型对象的方法---随机生成位置坐标
Box.prototype.random=function(){
    var x=Tools.getRandom(0,this.parent.offsetWidth/this.width-1)*this.width;
    // var x=Tools.getRandom(0,this.parent.offsetWidth-this.width)
    var y=Tools.getRandom(0,this.parent.offsetHeight/this.height-1)*this.height;
    // var y=Tools.getRandom(0,this.parent.offsetHeight-this.height);
    
    this.div.style.left=x+"px";
    this.div.style.top=y+"px";
}